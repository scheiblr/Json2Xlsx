-- returns value tree given a documentation date id
create or replace function f_get_values(_document_id INT)
  returns json as $$
select coalesce(json_agg(tmp),
  '[
    {
      "name": null,
      "value": null
    }
  ]' :: JSON)
  from
  (select
    name,
    value
  from
    lab_values_to_documentation_entity
      join lab_values using(value_id)
  where
    document_id = _document_id
  ) AS tmp
$$ language sql;

-- exports documents tree given a patient_id
create or replace function f_get_documents(_patient_id INT)
returns json as $$
-- if there is no tuple, return the empty entity
select coalesce(json_agg(tmp),
  '[
    {
      "document_id": null,
      "visit_date": null,
      "to_delete": null,
      "values": [ { "name": null , "value":null } ]
    }
  ]' :: JSON)
  from
  (select
    document_id,
    visit_date,
    to_delete,
    f_get_values(document_id) as lab_values
  from
    documentation_entity
  where
    patient_id = _patient_id
  ) AS tmp
$$ language sql;

-- data export view
create view v_export as
select
  patient_id,
  lastname,
  firstname,
  deceased,
  f_get_documents(patient_id) as documents
from patient
order by patient_id;

-- data export function
create function f_export(INT [])
  returns setof v_export
as
$$
select *
from v_export
  where patient_id = ANY($1)
$$ language sql;
