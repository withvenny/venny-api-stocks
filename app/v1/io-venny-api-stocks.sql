select * from stocks;
select * from stock_valuations;

INSERT INTO stocks(symbol,company) VALUES(:symbol,:company);
INSERT INTO stocks(symbol,company) VALUES('NTRZ','Notearise');
INSERT INTO stock_valuations(stock_id,value_on,price) VALUES(1,'12/12/2019',37);

CREATE TABLE accounts(
   id SERIAL PRIMARY KEY,
   first_name CHARACTER VARYING(100),
   last_name CHARACTER VARYING(100)
);
select * from accounts;
 
CREATE TABLE plans(
   id SERIAL PRIMARY KEY,
   plan CHARACTER VARYING(10) NOT NULL
);
select * from plans;
 
CREATE TABLE account_plans(
   account_id INTEGER NOT NULL,
   plan_id INTEGER NOT NULL,
   effective_date DATE NOT NULL,
   PRIMARY KEY (account_id,plan_id),
   FOREIGN KEY(account_id) REFERENCES accounts(id),
   FOREIGN KEY(plan_id) REFERENCES plans(id)
);
select * from account_plans;

INSERT INTO plans(plan) VALUES('SILVER'),('GOLD'),('PLATINUM');

CREATE OR REPLACE FUNCTION add(
    a INTEGER,
    b INTEGER)
  RETURNS integer AS $$
BEGIN
return a + b;
END; $$
  LANGUAGE 'plpgsql';
  
CREATE OR REPLACE FUNCTION get_accounts()
  RETURNS TABLE(id integer, 
                first_name character varying, 
                last_name character varying, 
                plan character varying, 
                effective_date date) AS
$$
BEGIN
 RETURN QUERY 
 
 SELECT a.id,a.first_name,a.last_name, p.plan, ap.effective_date
 FROM accounts a
 INNER JOIN account_plans ap on a.id = account_id
 INNER JOIN plans p on p.id = plan_id
 ORDER BY a.id, ap.effective_date;
END; $$
 
LANGUAGE plpgsql;




/* PostgreSQL PHP: Working with BLOB */

CREATE TABLE company_files (
     id        SERIAL PRIMARY KEY,
     stock_id  INTEGER NOT NULL,
     mime_type CHARACTER VARYING(255) NOT NULL,
     file_name CHARACTER VARYING(255) NOT NULL,
     file_data BYTEA NOT NULL,
     FOREIGN KEY(stock_id) REFERENCES stocks(id)
);

select * from company_files;
SELECT * FROM company_files;

SELECT id, file_data, mime_type FROM company_files WHERE id=5;

/* PostgreSQL PHP: Delete Data From a Table */
SELECT * FROM stocks ORDER BY id;

/* Playing around with Stored Procedures */
