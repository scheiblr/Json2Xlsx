-- returns value tree given a documentation date id
-- use JSONB here in order to make it compatible with DISTINCT (below)
create or replace function f_get_values(_document_id INT)
  returns jsonb as $$
select coalesce(jsonb_agg(tmp),
  '[
    {
      "name": null,
      "value": null
    }
  ]' :: JSONB)
  from
  (select distinct
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
-- use JSONB here in order to make it compatible with DISTINCT (below)
create or replace function f_get_documents(_patient_id INT)
returns jsonb as $$
-- if there is no tuple, return the empty entity
select coalesce(jsonb_agg(tmp),
  '[
    {
      "document_id": null,
      "visit_date": null,
      "to_delete": null
    }
  ]' :: JSONB)
  from
  (select distinct
    document_id,
    visit_date,
    to_delete
  from
    documentation_entity
  where
    patient_id = _patient_id
  ) AS tmp
$$ language sql;

-- view which contains all data
-- use DISTINCT to remove duplicates
create or replace view v_all_data as
select distinct
  'patient data' as "headline_p",
  patient_id,
  lastname,
  firstname,
  deceased,

  'documentation dates' as "headline_dd",
  f_get_documents(patient_id) as documents,

  'lab values' as "headline_lv",
  f_get_values(document_id) as lab_values
from patient
  join documentation_entity using(patient_id)
order by patient_id;

-- data export view
-- use JSON here in order to keep the order of columns
create or replace view v_export as
select coalesce(json_agg(tmp), '[]' :: JSON) AS export
from (select * from v_all_data)
as tmp;

-- data export function
-- use JSON here in order to keep the order of columns
create or replace function f_export(INT [])
  returns JSON
as
$$
select coalesce(json_agg(tmp),
  '[]' :: JSON)
  from
  (select *
  from v_all_data
    where patient_id = ANY($1)) as tmp
$$ language sql;
