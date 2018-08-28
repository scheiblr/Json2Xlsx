
-- This file is generated by the DataFiller free software.
-- This software comes without any warranty whatsoever.
-- Use at your own risk. Beware, this script may destroy your data!
-- License is GPLv3, see http://www.gnu.org/copyleft/gpl.html
-- Get latest version from http://www.coelho.net/datafiller.html

-- Data generated by: /usr/local/bin/datafiller
-- Version 2.0.1-dev (r832 on 2015-11-01)
-- For postgresql on 2018-08-27T13:31:30.959395 (UTC)
-- 
-- fill table patient (100)
\echo # filling table patient (100)
COPY patient (patient_id,lastname,firstname,deceased) FROM STDIN (ENCODING 'UTF-8', FREEZE ON);
1	Jin	Williams	FALSE
2	Ferdinanda	Cupido	FALSE
3	Inam	Della	TRUE
4	Cosette	Khesin	FALSE
5	Karolien	Rfa	FALSE
6	Kyle	Goertzen	TRUE
7	Jane	Wesenberg	FALSE
8	Wini	Bruhl	FALSE
9	Wynne	Mihan	FALSE
10	Helenelizabeth	Esteghamat	FALSE
11	Hilliary	Stirling	FALSE
12	Shirley	Piercey	FALSE
13	VuHoan	Lancaster	TRUE
14	Jenny	Lahey	FALSE
15	Elyssa	Chanco	FALSE
16	Ossama	Gallion	FALSE
17	Gaby	Eisenhart	FALSE
18	Lujanka	Ensign	FALSE
19	Grier	Wasitova	FALSE
20	Anantha	Srivastava	FALSE
21	Gilda	Parrilli	FALSE
22	Morgan	Halford	FALSE
23	Lydda-June	Buffam	FALSE
24	Caryn	McGowan	TRUE
25	Emelina	Kearns	FALSE
26	Annet	Pimiskern	FALSE
27	Hojjat	Abdul-Nour	FALSE
28	Diamond	McGregor	FALSE
29	Lavinia	Stephen	FALSE
30	Elberta	Tchir	FALSE
31	Alfons	Shute	FALSE
32	Kip	Mainville	TRUE
33	Lorenzo	Namiki	FALSE
34	Celestia	Soldera	FALSE
35	Al	Debnam	TRUE
36	Anabal	Pilote	TRUE
37	Myrtle	Aboul-Magd	FALSE
38	Yasmin	Garcia-Lamarca	FALSE
39	Beret	Smelters	FALSE
40	L;urette	Cocco	TRUE
41	Janelle	Irccar	FALSE
42	Shashi	Prosyk	FALSE
43	Mellisent	Theocharakis	TRUE
44	Alys	Wease	FALSE
45	Peggie	Kell	TRUE
46	Paqs	Webber	FALSE
47	Ebrahim	Asdel	TRUE
48	Henriette	Corsale	FALSE
49	Sayre	Aumoine	TRUE
50	Mickey	Cocco	FALSE
51	Connie	Saunders	TRUE
52	Andria	Hoeler	TRUE
53	Jean-Luc	Rafol	FALSE
54	Rozalin	Katz	FALSE
55	Andreana	Trader	TRUE
56	Allyce	Zalite	FALSE
57	Brooks	Mettrey	FALSE
58	Lorie	Delisle	FALSE
59	Nando	Pagliarulo	TRUE
60	Terra	Kokoska	TRUE
61	Nancee	Cobley	FALSE
62	Calypso	Chronowic	TRUE
63	Adel	Kaoud	FALSE
64	Carine	Narayan	FALSE
65	Kissiah	Buehler	FALSE
66	Ketty	Kehler	FALSE
67	Arvin	Valerien	TRUE
68	Roelof	Stover	FALSE
69	Lars	Plourde	FALSE
70	Carm	Villeneuve	FALSE
71	Lorelle	Coulson	FALSE
72	Mufinella	Koren	FALSE
73	Sandro	McMann	FALSE
74	Lizz	Scanlan	FALSE
75	Erlene	Wyant	TRUE
76	Shahram	Beckman	FALSE
77	Dvs	Searles	FALSE
78	Kym	Calder	TRUE
79	Nona	Wambsganz	FALSE
80	Tarah	Capps	TRUE
81	Cathyleen	Yousuf	FALSE
82	Armando	Prakash	FALSE
83	Claudine	Bluethner	TRUE
84	Mabelle	Culberson	FALSE
85	Saidee	Cotter	FALSE
86	Alfreda	SchaeferNTMVAA	FALSE
87	Eugene	Fujiwara	FALSE
88	Synful	Tregenza	FALSE
89	Karee	Nordskog	FALSE
90	Wilford	Braun	TRUE
91	Cheuk	Krautle	FALSE
92	Philippa	Kessing	FALSE
93	Rigel	Townsend	FALSE
94	Odessa	Camel-Toueg	FALSE
95	Britte	Bayer	FALSE
96	Erin	Maynard	FALSE
97	Chung-Cheung	Leung	FALSE
98	Yetty	Osiakwan	FALSE
99	Vance	Mayne	TRUE
100	Trudi	Ecroyd	FALSE
\.
-- 
-- fill table documentation_entity (250)
\echo # filling table documentation_entity (250)
COPY documentation_entity (document_id,patient_id,visit_date,to_delete) FROM STDIN (ENCODING 'UTF-8', FREEZE ON);
1	78	2000-06-09	TRUE
2	64	2004-11-15	TRUE
3	28	2010-03-27	FALSE
4	79	2007-11-20	FALSE
5	99	2004-06-21	TRUE
6	11	2010-11-19	TRUE
7	97	2017-02-26	TRUE
8	2	2009-07-06	TRUE
9	99	2016-03-09	TRUE
10	53	2012-10-08	FALSE
11	91	2016-03-18	TRUE
12	67	2017-04-02	FALSE
13	42	2012-01-10	TRUE
14	81	2008-04-15	TRUE
15	18	2012-01-03	TRUE
16	58	2006-08-30	TRUE
17	17	2013-10-04	TRUE
18	52	2010-03-29	TRUE
19	27	2000-03-24	TRUE
20	6	2008-03-04	TRUE
21	21	2005-10-28	TRUE
22	11	2004-03-26	TRUE
23	86	2003-12-21	TRUE
24	58	2003-07-07	TRUE
25	61	2001-05-25	TRUE
26	63	2010-11-09	TRUE
27	20	2007-04-07	TRUE
28	30	2004-11-07	TRUE
29	34	2016-08-20	TRUE
30	19	2010-04-06	TRUE
31	43	2003-01-10	TRUE
32	34	2007-11-14	TRUE
33	50	2016-01-12	TRUE
34	51	2000-01-05	TRUE
35	75	2005-10-05	TRUE
36	10	2001-05-12	FALSE
37	78	2004-06-09	TRUE
38	69	2009-06-05	FALSE
39	9	2009-03-02	FALSE
40	22	2005-04-12	FALSE
41	92	2010-02-28	TRUE
42	36	2009-04-02	TRUE
43	28	2003-01-09	TRUE
44	65	2009-02-04	TRUE
45	71	2010-05-11	FALSE
46	61	2003-07-12	TRUE
47	71	2000-08-27	TRUE
48	37	2017-03-25	TRUE
49	70	2008-08-02	TRUE
50	30	2013-12-06	TRUE
51	99	2004-02-19	TRUE
52	41	2014-05-05	TRUE
53	3	2012-10-31	TRUE
54	93	2011-11-04	FALSE
55	84	2010-12-25	TRUE
56	61	2006-04-03	TRUE
57	98	2016-01-24	TRUE
58	15	2015-10-14	TRUE
59	83	2006-02-09	TRUE
60	81	2013-04-21	FALSE
61	82	2016-05-03	TRUE
62	41	2016-02-16	TRUE
63	15	2008-04-11	FALSE
64	50	2010-09-03	TRUE
65	68	2001-01-10	TRUE
66	62	2005-05-02	TRUE
67	67	2006-08-14	FALSE
68	82	2005-07-10	FALSE
69	75	2003-07-15	TRUE
70	91	2004-05-28	TRUE
71	18	2014-11-15	TRUE
72	89	2002-03-18	TRUE
73	31	2007-11-25	TRUE
74	17	2007-08-04	TRUE
75	85	2013-12-22	TRUE
76	29	2015-12-09	TRUE
77	3	2013-01-11	FALSE
78	70	2002-01-05	TRUE
79	51	2012-10-27	TRUE
80	17	2014-09-03	TRUE
81	78	2003-06-05	TRUE
82	5	2007-09-03	FALSE
83	92	2013-12-04	TRUE
84	76	2008-06-17	TRUE
85	67	2004-05-28	TRUE
86	8	2012-08-16	FALSE
87	98	2012-02-23	FALSE
88	80	2006-10-05	TRUE
89	86	2013-09-27	FALSE
90	29	2000-05-29	TRUE
91	1	2002-01-18	TRUE
92	99	2009-12-02	TRUE
93	49	2016-01-15	TRUE
94	18	2005-03-16	TRUE
95	54	2000-02-03	TRUE
96	86	2010-12-05	TRUE
97	87	2012-04-15	FALSE
98	100	2002-01-02	TRUE
99	34	2013-09-19	TRUE
100	7	2013-11-02	TRUE
101	21	2006-01-03	TRUE
102	52	2003-04-23	TRUE
103	3	2016-05-11	FALSE
104	81	2007-11-19	TRUE
105	43	2007-07-01	TRUE
106	6	2007-01-30	TRUE
107	95	2011-11-26	FALSE
108	95	2004-01-26	TRUE
109	38	2010-08-29	TRUE
110	43	2007-12-20	TRUE
111	75	2016-08-11	TRUE
112	87	2004-09-24	FALSE
113	27	2013-06-04	TRUE
114	80	2017-01-13	FALSE
115	25	2006-08-18	FALSE
116	47	2002-06-24	FALSE
117	82	2000-01-02	TRUE
118	25	2017-03-09	TRUE
119	48	2010-12-12	TRUE
120	22	2010-08-27	TRUE
121	28	2017-05-12	TRUE
122	36	2016-12-03	TRUE
123	79	2012-10-20	TRUE
124	87	2002-08-31	FALSE
125	98	2001-02-26	TRUE
126	78	2015-11-09	TRUE
127	25	2001-07-08	TRUE
128	93	2002-08-19	FALSE
129	2	2011-11-30	FALSE
130	34	2010-02-25	FALSE
131	68	2009-10-05	FALSE
132	88	2007-03-20	TRUE
133	55	2015-08-17	TRUE
134	66	2012-11-21	TRUE
135	26	2014-03-08	TRUE
136	42	2017-02-10	FALSE
137	74	2017-05-21	TRUE
138	2	2013-12-31	FALSE
139	39	2011-01-30	TRUE
140	11	2012-02-05	TRUE
141	46	2000-10-17	FALSE
142	57	2016-03-30	TRUE
143	95	2015-02-06	TRUE
144	47	2011-08-22	FALSE
145	13	2015-03-23	TRUE
146	52	2005-01-07	TRUE
147	28	2010-01-24	FALSE
148	55	2015-10-10	FALSE
149	96	2005-01-28	TRUE
150	100	2007-04-15	TRUE
151	85	2000-02-28	FALSE
152	17	2000-01-15	TRUE
153	10	2012-10-28	FALSE
154	87	2004-12-23	TRUE
155	96	2013-05-19	FALSE
156	10	2009-08-29	FALSE
157	29	2001-10-31	TRUE
158	96	2007-09-30	TRUE
159	58	2016-04-01	TRUE
160	35	2015-04-10	TRUE
161	14	2007-01-15	FALSE
162	22	2011-05-24	FALSE
163	29	2012-08-24	TRUE
164	8	2014-12-09	TRUE
165	82	2011-04-12	TRUE
166	52	2003-03-11	TRUE
167	25	2005-04-30	TRUE
168	94	2005-12-04	TRUE
169	46	2008-09-22	TRUE
170	78	2005-02-07	TRUE
171	42	2013-03-13	TRUE
172	74	2016-10-09	FALSE
173	67	2002-02-17	TRUE
174	73	2001-11-06	TRUE
175	75	2007-08-24	TRUE
176	91	2015-07-01	TRUE
177	26	2002-05-01	TRUE
178	19	2007-08-02	TRUE
179	18	2012-08-16	TRUE
180	61	2009-01-25	TRUE
181	70	2017-05-11	FALSE
182	77	2001-08-12	TRUE
183	3	2006-03-03	FALSE
184	73	2008-10-04	FALSE
185	44	2005-10-06	TRUE
186	90	2001-04-11	TRUE
187	3	2000-12-25	TRUE
188	86	2003-02-06	TRUE
189	24	2014-08-01	TRUE
190	83	2016-04-13	TRUE
191	14	2009-11-15	TRUE
192	95	2000-07-29	TRUE
193	27	2012-05-16	TRUE
194	30	2016-11-02	TRUE
195	26	2012-04-18	FALSE
196	2	2010-01-28	TRUE
197	19	2007-08-07	TRUE
198	87	2016-09-04	TRUE
199	33	2010-03-09	TRUE
200	11	2005-02-18	TRUE
201	25	2010-05-07	TRUE
202	23	2016-11-14	FALSE
203	42	2017-05-21	FALSE
204	52	2010-05-07	TRUE
205	56	2013-06-16	TRUE
206	5	2003-05-06	TRUE
207	82	2013-05-10	TRUE
208	67	2002-04-01	TRUE
209	21	2008-02-10	TRUE
210	42	2015-10-01	TRUE
211	28	2007-06-28	TRUE
212	11	2017-05-10	FALSE
213	31	2016-05-25	TRUE
214	98	2015-01-12	TRUE
215	34	2009-06-23	TRUE
216	1	2015-02-10	TRUE
217	41	2012-10-17	TRUE
218	24	2011-12-30	TRUE
219	27	2003-10-10	TRUE
220	29	2008-01-24	FALSE
221	12	2004-05-31	TRUE
222	51	2016-06-16	TRUE
223	85	2013-08-01	TRUE
224	88	2009-12-25	FALSE
225	15	2016-08-02	TRUE
226	16	2003-01-18	FALSE
227	45	2014-09-13	TRUE
228	44	2005-04-17	TRUE
229	36	2002-02-08	TRUE
230	18	2005-07-18	FALSE
231	62	2004-08-04	FALSE
232	82	2011-08-26	FALSE
233	20	2013-06-18	TRUE
234	13	2004-07-09	TRUE
235	95	2016-10-03	TRUE
236	30	2008-02-24	TRUE
237	6	2011-08-27	TRUE
238	62	2005-01-23	TRUE
239	79	2000-01-06	TRUE
240	100	2001-02-19	TRUE
241	71	2008-09-12	TRUE
242	21	2002-03-20	TRUE
243	89	2012-03-24	TRUE
244	51	2004-05-06	TRUE
245	21	2015-10-02	FALSE
246	53	2013-07-29	TRUE
247	41	2009-10-25	TRUE
248	25	2013-06-30	TRUE
249	46	2016-03-01	FALSE
250	48	2005-02-05	FALSE
\.
-- 
-- fill table lab_values (31)
\echo # filling table lab_values (31)
COPY lab_values (value_id,name) FROM STDIN (ENCODING 'UTF-8', FREEZE ON);
1	WBC
2	RBC
3	Hgb
4	Hct
5	RET
6	MCV
7	MCH
8	MCHC
9	MPV fl
10	Platelets
11	Neutrophil
12	Lymphs
13	Monocytes
14	Eosinophils
15	Basophils
16	Bilirubin
17	IG
18	nRBC
19	Calcium
20	BUN
21	Creatinine
22	Iron
23	Ferritin
24	Haptoglobin
25	IBC
26	IGA
27	IGE
28	IGG
29	IGM
30	Vitamin B12
31	Folic Acid
\.
-- 
-- fill table lab_values_to_documentation_entity (100)
\echo # filling table lab_values_to_documentation_entity (100)
COPY lab_values_to_documentation_entity (document_id,value_id,value) FROM STDIN (ENCODING 'UTF-8', FREEZE ON);
98	16	0.5301659063311428
250	14	0.6487405376441406
90	30	0.5864085968944814
215	7	0.1238555834328765
230	28	0.10063881141147024
135	30	0.9281066383567972
141	10	0.0629359867175352
102	7	0.5758679125080053
234	4	0.8137495159136462
79	30	0.8520996061501239
212	2	0.07248913445859861
107	8	0.0038705343377497536
58	27	0.8844355093791602
152	16	0.7993403223937905
169	4	0.060574122975636024
136	9	0.1518172817174036
117	7	0.9137126482794808
214	12	0.9176407578543443
169	31	0.8678618565438855
33	30	0.36129233099687386
80	6	0.7690016748691306
82	25	0.4923774158782672
30	2	0.13513706690113314
102	14	0.7169584771701201
77	26	0.19295536825502968
161	31	0.04563742171217067
7	22	0.2208765288537058
163	17	0.6606843047619232
66	24	0.26625680626389325
108	16	0.768372439102875
31	3	0.40005836547996765
174	7	0.6017343139095526
226	4	0.557948072205819
78	2	0.15116534852388575
173	16	0.8817052709782447
194	28	0.0008372869516938275
223	26	0.9564035366466623
67	3	0.9054542000450542
190	5	0.975585877358601
247	7	0.0707129947301064
113	3	0.3624685320794041
241	12	0.044620080392309025
178	5	0.12468085362492642
33	8	0.024874328386581657
200	11	0.7079187795624469
107	17	0.7300654856767778
132	9	0.3779349272692789
62	7	0.6695332823723835
247	28	0.44972436552622075
183	13	0.9657275480457951
205	16	0.14981433652207243
215	9	0.9230494168432736
198	20	0.5869460639268279
104	17	0.26157670109069453
159	16	0.45662094112800367
89	14	0.6113253192793232
38	30	0.5527769113320625
34	29	0.791148511558849
109	24	0.022425851538365293
25	7	0.39139074235282056
194	13	0.2166262622410735
7	27	0.6561235203415638
214	29	0.08846651214168222
241	5	0.7600580608440859
23	7	0.15817974269970214
246	3	0.9982820418839607
248	14	0.6615189882458341
10	6	0.8092240129337502
167	18	0.8028776736316358
168	23	0.513504093476482
20	9	0.343443231713504
170	2	0.41103740943452305
86	27	0.42773302868628427
217	26	0.6504411564270377
186	17	0.8293934496584976
30	20	0.0138802741373788
80	5	0.9835394379229101
103	29	0.18225928771090338
223	9	0.027769760470690907
146	10	0.10564115603550017
160	4	0.7027689297131784
137	1	0.1956573308442987
177	27	0.3610379666803961
77	29	0.0026166800009936875
207	20	0.3697645094280404
104	12	0.49990431962079307
125	25	0.5407978841564849
235	1	0.3812344664191959
9	29	0.21116569059634605
75	4	0.1334996046517768
95	1	0.15283412889116432
87	26	0.2813367788553949
208	26	0.39533626676873257
76	19	0.18481873183978814
50	14	0.5093139473120282
134	27	0.3527441938476197
169	25	0.8780507701739682
111	27	0.6900639357690654
172	4	0.03804213728939765
173	24	0.5070800959236572
\.
-- 
-- restart sequences
ALTER SEQUENCE patient_patient_id_seq RESTART WITH 101;
ALTER SEQUENCE documentation_entity_document_id_seq RESTART WITH 251;
ALTER SEQUENCE lab_values_value_id_seq RESTART WITH 32;
-- 
-- analyze modified tables
ANALYZE patient;
ANALYZE documentation_entity;
ANALYZE lab_values;
ANALYZE lab_values_to_documentation_entity;