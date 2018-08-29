-- database structure including datafiller definitions
-- see https://github.com/memsql/datafiller/blob/master/TUTORIAL.md

-- df fn: word=./word_lists/Given-Names
-- df ln: word=./word_lists/Family-Names
create table patient (
  patient_id serial primary key ,
  lastname text not null, -- df: use=fn
  firstname text not null, -- df: use=ln
  deceased boolean default null -- df: rate=0.25
);


create table visits ( --df: mult=2.5
  visit_id SERIAL primary key,
  patient_id integer references patient(patient_id),
  visit_date date not null, -- df: start=2000-01-01 end=2018-06-01
  news boolean not null -- df: rate=0.75
);

-- df lv: word=./word_lists/Lab-Values
create table lab_values (-- df: size=31
  value_id serial primary key,
  name text unique not null -- df: use=lv
);


-- df lf: float
create table lab_values_to_patient ( --df: mult=3.0
  patient_id integer references patient(patient_id),
  value_id integer references lab_values(value_id),
  value decimal not null, -- df: use=lf
  date_recorded date not null, -- df: start=2010-01-01 end=2017-06-01
  primary key (value_id, patient_id)
);