
/********************************* Photographe *************************************/

SELECT * FROM image WHERE code_acces_image = "ertert" AND desc_image = "test 1 pour ajout des informations de l'image"
                                            and lien_image = 'on verra plus tard' and mail_photographe = "hugo@gmail.com"
                                            and nom_image = "test1" and id_collection = null and prix_ht_image = 5.54

/********************************* Fin Photographe *************************************/

/********************************* Image *************************************/
INSERT INTO image(code_acces_image, date_upload_image, desc_image, image_visible, lien_image,
			 									mail_photographe, nom_image, id_collection, prix_ht_image)
												VALUES (null, "2019-05-05", "test 11 pour l'ajout des infos", false,
                                                    "on verra plus tard", "hugo@gmail.com", "test11", null, 9.50)

SELECT * FROM image WHERE code_acces_image = ? AND desc_image = ?
                                            and lien_image = ? and mail_photographe = ? and nom_image = ?
                                            and id_collection = ? and prix_ht_image = ?
/********************************* Fin Image *************************************/

/********************************* Collection *************************************/
INSERT INTO collection(nom_collection, date_creation, collection_visible,
															code_acces_collection, mail_photographe)
													VALUES ('testCol1', "2018-05-05", 1, null, 'hugo@gmail.com')

/********************************* Fin Collection *************************************/

/********************************* Support *************************************/

INSERT INTO `support`(`type_support`, `dimension_min`, `dimension_max`, `prix_ht_support`) VALUES ("T-shirt", 0, 2000, 12.00)

/********************************* Fin Support *************************************/
