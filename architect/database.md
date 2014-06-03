
# Preface
-  any word with * in prefix is not a table, so do the highest level of table list.
-  [this is comment] stores comment.


# Brief view of the database structure


- item	`Stores the item information`
	- item	`stores common attributes`	
		- item_attributes
		- item_attachments
		- item_prices
		- item_sections

	- places	`places secondary page setup, linked with attachment`

		|     name   | type        | 					description      			 |  				comment 	      |
 		| ---------- | ----------- | ----------------------------------------------- | ---------------------------------- |
 		|     id     | integer     | primary id, auto increment 					 | 							  		  |
 		| admin_user | integer     | the admin user's id                     		 | 							  		  |
 		|  location  | integer     | the location id which came from location table	 | 							  		  |
 		|  keyword   | char(255)   | use to enhance search result                	 | 							  		  |
 		|create_time | integer     | system default                              	 | 							  		  |

	- item_attachment  `this table use 'type' column to distinguish different type of products, like item and article
		
		|     name   | type        | 					description      			 |  				comment 	      |
 		| ---------- | ----------- | ----------------------------------------------- | ---------------------------------- |
 		|     id     | integer     | primary id, auto increment 					 | 							  		  |
 		|  filetype  | char(20)    | doc\image                  	             	 | 							  		  |
 		|  	 type    | char(20)    | item\article\places                          	 | 							  		  |
 		| product_id | integer     | item\article\places id                     	 | 							  		  |
 		|     path   | char(255)   | the file's path                             	 | 							  		  |
 		|  title     | char(255)   |                                             	 | 							  		  |
 		|  desc      | text        |                                             	 | 							  		  |
 		|  link      | char(255)   | where the image will be linked to               | 							  		  |
 		|create_time | integer     | system default                              	 | 							  		  |

	- promotions

	- location	`continents, countries & cities`
		
		|     name   | type        | 					description      			 |  				comment 	      |
 		| ---------- | ----------- | ----------------------------------------------- | ---------------------------------- |
 		|     id     | integer     | primary id, auto increment 					 | 							  		  |
 		| 	 name    | char(255)   | location name, english by default               | 							  		  |
 		|   zh_CN    | char(255)   | the chinese version of location             	 | 							  		  |
 		|  keyword   | char(255)   | use to enhance search result                	 | 							  		  |
 		|  parent_id | char(255)   | parent location id                           	 | 							  		  |
 		| create_time| integer     | system default                              	 | 							  		  |

- system	`system configuration`
 	- config

 		|     name   | type        | 					description      			 |  				comment 	      |
 		| ---------- | ----------- | ----------------------------------------------- | ---------------------------------- |
 		|     id     | smallint(5) | primary id, auto increment 					 | 							  		  |
 		| parent_id  | smallint(5) | parent_configuration			                 | 							  		  |
 		|   code     | char(255)   | this configuration item's code name          	 | 							  		  |
 		|  type      | char(10)    | text | radio | checkbox                    	 | 							  		  |
 		| options    |  text       | stores default value and options             	 | one line per value, name:value	  |
 		| store_range| char(255)   | parent location id                           	 | 							  		  |
 		| store_dir  | char(255)   | parent location id                           	 | 							  		  |
 		| value  	 |    text     | parent location id                           	 | 							  		  |
 		| create_time| integer     | system default                              	 | 							  		  |

- comment	`user's comment of item, article & so on`
 	- comment
	
 		|     name   | type        | 					description      			 |  				comment 	      |
 		| ---------- | ----------- | ----------------------------------------------- | ---------------------------------- |
 		|       id   | integer     | primary id, auto increment 					 | 							  		  |
 		|     user   | integer     | the user's id, if visitor then null			 | 							  		  |
 		|     ip     | char(255)   | the user's ip address, record for future usage	 | 							  		  |
 		|    comment | text        | comment content                     			 | 							  		  |
 		| session_id | char(255)   | record session id when user leave a comment	 | 							  		  |
 		| type       | char(20)    | article / item                              	 | 							  		  |
 		| product_id | char(20)    | article / item  id                           	 | 							  		  |

 
- log&statistics
 	- error_log	`record error information which happened both in frontend and backend`
		
			|     name      | type        | 					description      			 |  				comment 	      |
	 		| ---------- -- | ----------- | -------------------------------------------------| ---------------------------------- |
	 		|      id       | integer     | primary id, auto increment 					     | 							  		  |
	 		|  ip_address   | varchar(30) | total days,calculated from counting itemplan TB  | 							  		  |
	 		| visit_times   | smallint(5) | counting 									     | 							  		  |
	 		|  browser      | varchar(60) | detect the header of browser   					 | 							  		  |
	 		|  system       | varchar(20) | detect the header of system   					 | 							  		  |
	 		|  language     | varchar(60) | detect the header of language  					 | 							  		  |
	 		|  referer      | varchar(255)| refererence url				 					 | 							  		  |
	 		|  access_url   | varchar(200)|  which page has been visited   					 | 							  		  |
	 		| create_time   | integer     | system default                              	 | 							  		  |
	

 	- stats		`user's information`

 			|     name      | type        | 					description      			 |  				comment 	      |
	 		| ---------- -- | ----------- | -------------------------------------------------| ---------------------------------- |
	 		|      id       | integer     | primary id, auto increment 					     | 							  		  |
	 		|  ip_address   | varchar(30) | total days,calculated from counting itemplan TB  | 							  		  |
	 		| visit_times   | smallint(5) | counting 									     | 							  		  |
	 		|  browser      | varchar(60) | detect the header of browser   					 | 							  		  |
	 		|  system       | varchar(20) | detect the header of system   					 | 							  		  |
	 		|  language     | varchar(60) | detect the header of language  					 | 							  		  |
	 		|  referer      | varchar(255)| refererence url				 					 | 							  		  |
	 		|  access_url   | varchar(200)|  which page has been visited   					 | 							  		  |
	 		| create_time   | integer     | system default                              	 | 							  		  |

 	- admin_log		`administrator's operation log`


- order
 	- order
 		- order_item

 			|     name   | type        | 					description      			 |  				comment 	      |
	 		| ---------- | ----------- | ----------------------------------------------- | ---------------------------------- |
	 		|       id   | integer     | primary id, auto increment 					 | 							  		  |
	 		|  order_id  | integer     | linked to main order_info record             	 | 							  		  |
	 		|  item_id   | integer     |  product's id                           		 | 							  		  |
	 		|  item_name | char(255)   | came from item table 							 | 							  		  |
	 		| item_price |decimal(10,2)| came from calculated price acd. to price table  | 							  		  |
	 		|send_number | tinyint(2)  | 0/negative   1/sent               				 | 							  		  |
	 		|item_amount | smallint(5) | how many items were bought                   	 | 							  		  |
	 		| raw_info   | text        | serialize the user's input input array      	 | 							  		  |
	 		| create_time| integer     | system default                              	 | 							  		  |

		- order_plan

			|     name      | type        | 					description      			 |  				comment 	      |
	 		| ---------- -- | ----------- | -------------------------------------------------| ---------------------------------- |
	 		|      id       | integer     | primary id, auto increment 					     | 							  		  |
	 		|  duration	    | integer     | total days,calculated from counting itemplan TB  | 							  		  |
	 		|start_timestamp| integer     | total days,calculated from counting itemplan TB  | 							  		  |
	 		|  end_timestamp| integer     | total days,calculated from counting itemplan TB  | 							  		  |
	 		| create_time   | integer     | system default                              	 | 							  		  |

 		- order_plan_item

 			|     name      | type        | 					description      			 |  				comment 	      |
	 		| ------------- | ----------- | ------------------------------------------------ | ---------------------------------- |
	 		|      id       | integer     | primary id, auto increment 					     | 							  		  |
	 		|order_plan_id  | integer     | linked to main order_plan record             	 | 							  		  |
	 		|order_item_id  | integer     |  linked to order_item's id                       | 							  		  |
	 		| start_offset  | integer     | this item's position in schedule				 | 							  		  |
	 		| end_offset    | integer     | 					               				 | 							  		  |
	 		| create_time   | integer     | system default                              	 | 							  		  |

 		- order_info

 			|     name   | type        | 					description      			 |  				comment 	      |
	 		| ---------- | ----------- | ----------------------------------------------- | ---------------------------------- |
	 		|       id   | integer     | primary id, auto increment 					 | 							  		  |
	 		|  order_sn  | char(255)   | automatic generatator, unique		         	 | 							  		  |
	 		| user_id    | integer     | the user who invoked this order               	 | 							  		  |
	 		|order_status| tinyint(2)  | 0/unconfirm 1/confirm 2/cancel 3/return         | 							  		  |
	 		| pay_status | tinyint(2)  | 0/unpay 1/paying 2/paid                     	 | 							  		  |
	 		| address_id | integer     | use the address in address table            	 | 							  		  |
	 		| notes      | char(255)   | note leave by user who have additional request  | 							  		  |
	 		| pay_id     | tinyint(2)  | 0/alipay 1/chinapay TD:should be replaced by TB | 							  		  |
	 		|confirm_time| int(10)     | timestamp format, when order was confirm        | 							  		  |
	 		|  pay_time  | int(10)     | timestamp format, when order was paid           | 							  		  |
	 		|  to_buyer  | char(255)   | the seller's note to customer                   | 							  		  |
	 		|order_plan_id| integer    | linked to main order_plan record                | 							  		  |
	 		| create_time| integer     | system default                              	 | 							  		  |

 		- order_action

	 		|     name   | type        | 					description      			 |  				comment 	      |
	 		| ---------- | ----------- | ----------------------------------------------- | ---------------------------------- |
	 		|       id   | integer     | primary id, auto increment 					 | 							  		  |
	 		|  order_id  | integer     | linked to order_info                       	 | 							  		  |
	 		|action_user | integer     | the user who invoked this action             	 | 							  		  |
	 		|order_status| tinyint(2)  | 0/unconfirm 1/confirm 2/cancel 3/return         | 							  		  |
	 		|pay_status  | tinyint(2)  | 0/unpay 1/paying 2/paid                     	 | 							  		  |
	 		|shipping_status | tinyint(2) | 0/unshipped 1/on shipping  2/shipped     	 | 							  		  |
	 		|action_note | char(255)   | note leave by user who have additional request  | 							  		  |
	 		| create_time| integer     | system default                              	 | 							  		  |

 	- cart
 		- cart_item
			
			|     name   | type        | 					description      			 |  				comment 	      |
	 		| ---------- | ----------- | ----------------------------------------------- | ---------------------------------- |
	 		|       id   | integer     | primary id, auto increment 					 | 							  		  |
	 		|  cart_id   | integer     | linked to cart_info table                   	 | 							  		  |
	 		|  item_id   | integer     |  product's id                           		 | 							  		  |
	 		|  item_name | char(255)   | came from item table 							 | 							  		  |
	 		| item_price |decimal(10,2)| came from calculated price acd. to price table  | 							  		  |
	 		|send_number | tinyint(2)  | 0/negative   1/sent               				 | 							  		  |
	 		|item_amount | smallint(5) | how many items were bought                   	 | 							  		  |
	 		| raw_info   | text        | serialize the user's input input array      	 | 							  		  |
	 		| create_time| integer     | system default                              	 | 							  		  |

 		- cart_plan

 			|     name      | type        | 					description      			 |  				comment 	      |
	 		| ---------- -- | ----------- | -------------------------------------------------| ---------------------------------- |
	 		|      id       | integer     | primary id, auto increment 					     | 							  		  |
	 		|  duration	    | integer     | total days,calculated from counting itemplan TB  | 							  		  |
	 		|start_timestamp| integer     | total days,calculated from counting itemplan TB  | 							  		  |
	 		|  end_timestamp| integer     | total days,calculated from counting itemplan TB  | 							  		  |
	 		| create_time   | integer     | system default                              	 | 							  		  |

	 	- cart_plan_item

 			|     name      | type        | 					description      			 |  				comment 	      |
	 		| ------------- | ----------- | ------------------------------------------------ | ---------------------------------- |
	 		|      id       | integer     | primary id, auto increment 					     | 							  		  |
	 		| cart_plan_id  | integer     | linked to main  cart_plan record             	 | 							  		  |
	 		| cart_item_id  | integer     |  linked to  cart_item's id                       | 							  		  |
	 		| start_offset  | integer     | this item's position in schedule				 | 							  		  |
	 		| end_offset    | integer     | 					               				 | 							  		  |
	 		| create_time   | integer     | system default                              	 | 							  		  |

	 	- cart_info

 			|     name   | type        | 					description      			 |  				comment 	      |
	 		| ---------- | ----------- | ----------------------------------------------- | ---------------------------------- |
	 		|       id   | integer     | primary id, auto increment 					 | 							  		  |
	 		| user_id    | integer     | the user who invoked this order               	 | 							  		  |
	 		| address_id | integer     | use the address in address table            	 | 							  		  |
	 		| notes      | char(255)   | note leave by user who have additional request  | 							  		  |
	 		| pay_id     | tinyint(2)  | 0/alipay 1/chinapay TD:should be replaced by TB | 							  		  |
	 		|cart_plan_id| integer     | linked to main cart_plan record                 | 							  		  |
	 		| create_time| integer     | system default                              	 | 							  		  |


 	- payment
 		- pay_log

 			|     name   | type        | 					description      			 |  				comment 	      |
	 		| ---------- | ----------- | ----------------------------------------------- | ---------------------------------- |
	 		|       id   | integer     | primary id, auto increment 					 | 							  		  |
	 		|  order_id  | integer     | linked to order_info                       	 | 							  		  |
	 		|order_amount| integer     | the user who invoked this action             	 | 							  		  |
	 		|order_status|decimal(10,2)| the order's amount                              | 							  		  |
	 		|order_type  | tinyint(2)  | 0/alipay 1/chinapay 2/using balance             | 							  		  |
	 		|   is_paid  | tinyint(1)  | 0/unpay 1/paid  							   	 | 							  		  |
	 		| create_time| integer     | system default                              	 | 							  		  |

	 	- pay_method

	 		|     name   | type        | 					description      			 |  				comment 	      |
	 		| ---------- | ----------- | ----------------------------------------------- | ---------------------------------- |
	 		|       id   | integer     | primary id, auto increment 					 | 							  		  |
	 		|  pay_code  | char(255)   | short code for recognize                      	 | 							  		  |
	 		|  pay_name  | char(255)   | Payment method's name    		             	 | 							  		  |
	 		|  pay_fee   | var_char(20)| Charge-fee while using this method to pay       | 							  		  |
	 		| pay_config | text        | payment's configuration           			     | 							  		  |
	 		|  pay_desc  | text        | payment's description           			     | 							  		  |
	 		|   enabled  | tinyint(1)  | 0/false 1/true  							   	 | 							  		  |
	 		| create_time| integer     | system default                              	 | 							  		  |

 	- return_order


- vendor
 	- vendor_agency
 	- vendor_action

 - advertisement
 	- ad

 		|     name   | type        | 					description      			 |  				comment 	      |
 		| ---------- | ----------- | ----------------------------------------------- | ---------------------------------- |
 		|     id     | integer     | primary id, auto increment 					 | 							  		  |
 		|   ad_type  | char(20)    | gallery/image/text                  	         | 							  		  |
 		|position_id | integer     | item\article\places                          	 | 							  		  |
 		|     path   | char(255)   | the file's path                             	 | 							  		  |
 		|  title     | char(255)   |                                             	 | 							  		  |
 		|  desc      | text        |                                             	 | 							  		  |
 		|  link      | char(255)   | where the image will be linked to               | 							  		  |
 		|   start    | integer     |				                                 | 							  		  |
 		|   end      | integer     |				                                 | 							  		  |
 		|create_time | integer     | system default                              	 | 							  		  |

	- ad_position

		|     name     | type        | 					description      			   |  				comment 	      |
 		| ----------   | ----------- | ----------------------------------------------- | ---------------------------------- |
 		|     id       | smallint(5) | primary id, auto increment 					   | 							  		  |
 		| parent_id    | smallint(5) | 					          	             	   | 							  		  |
 		|position_name | char(255)   | 					                          	   | 							  		  |
 		|create_time   | integer       | system default                              	   | 							  		  |

- page
 	- page_category

		|     name     | type        | 					description      			 |  				comment 	      |
 		| ------------ | ----------- | ----------------------------------------------| ---------------------------------- |
 		|     id       | smallint(5) | primary id, auto increment 					 | 							  		  |
 		| parent_id    | smallint(5) | 					          	             	 | 							  		  |
 		|category_name | char(255)   | 					                          	 | 							  		  |
 		|category_desc | char(255)   |				                            	 | 							  		  |
 		|create_time   | integer     | system default                              	 | 							  		  |


 	- page

		|     name   | type        | 					description      			 |  				comment 	      |
 		| ---------- | ----------- | ----------------------------------------------- | ---------------------------------- |
 		|     id     | integer     | primary id, auto increment 					 | 							  		  |
 		|   user_id  | integer     | who post this page            	             	 | 							  		  |
 		|  post_date | integer     | item\article\places                          	 | 							  		  |
 		|   content  | text 	   | the file's path                             	 | 							  		  |
 		|  title     | char(255)   |                                             	 | 							  		  |
 		| post_status|  tinyint(2) |  0/draft 1/posted 2/waiting for review        	 | 							  		  | 
 		|create_time | integer     | system default                              	 | 							  		  |



- automatic
 	- cronjob
 	- auto_manage

- message
 	- message

 		|     name   | type        | 					description      			 |  				comment 	      |
 		| ---------- | ----------- | ----------------------------------------------- | ---------------------------------- |
 		|     id     | integer     | primary id, auto increment 					 | 							  		  |
 		|  from_user | char(255)   | who had sent this message                       | 							  		  |
 		|   to_user  | char(255)   | who will receive this message                	 | 							  		  |
 		| message    | char(255)   | message content                	    		 | 							  		  |
 		|     path   | char(255)   | the file's path                             	 | 							  		  |
 		|create_time | integer     | system default                              	 | 							  		  |

 	- archived_message
 	- feedback

- user
 	- user_account

 	- account_log

 		|     name   | type        | 					description      			 |  				comment 	      |
 		| ---------- | ----------- | ----------------------------------------------- | ---------------------------------- |
 		|     id     | integer     | primary id, auto increment 					 | 							  		  |
 		|  user_id   | integer     | who's account was changed                       | 							  		  |
 		| user_money |decimal(10,2)| the amount that this record involes           	 | 							  		  |
 		| change_desc| char(255)   | notes of this record              	    		 | 							  		  |
 		| change_type| tinyint(3)  | 0/charge 1/withdraw 2/admin adjust 99/other   	 | 							  		  |
 		|create_time | integer     | system default                              	 | 							  		  |

 	- address

 		|     name   | type        | 					description      			 |  				comment 	      |
 		| ---------- | ----------- | ----------------------------------------------- | ---------------------------------- |
 		|     id     | integer     | primary id, auto increment 					 | 							  		  |
 		|  user_id   | integer     | who's account was changed                       | 							  		  |
 		| consignee  | char(255)   | the amount that this record involes           	 | 							  		  |
 		| email      | char(255)   | notes of this record              	    		 | 							  		  |
 		| cellphone  | tinyint(3)  | 0/charge 1/withdraw 2/admin adjust 99/other   	 | 							  		  |
 		| phone      | char(255)   | notes of this record              	    		 | 							  		  |
 		| country    | char(255)   | notes of this record              	    		 | 							  		  |
 		| province   | char(255)   | notes of this record              	    		 | 							  		  |
 		| city       | char(255)   | notes of this record              	    		 | 							  		  |
 		| district   | char(255)   | notes of this record              	    		 | 							  		  |
 		| address    | char(255)   | notes of this record              	    		 | 							  		  |
 		| zipcode    | char(255)   | notes of this record              	    		 | 							  		  |
 		|create_time | integer     | system default                              	 | 							  		  |


 	- profile
