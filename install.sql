CREATE TABLE 'CartItems' (
  'id' int(11) unsigned NOT NULL AUTO_INCREMENT,
  'product_id' int(11) NOT NULL,
  'amount' int(11) NOT NULL DEFAULT '1',
  'name' varchar(45) DEFAULT NULL,
  PRIMARY KEY ('id'),
  KEY 'product_id_idx' ('product_id'),
  CONSTRAINT 'product_id' FOREIGN KEY ('product_id') REFERENCES 'products' (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;
