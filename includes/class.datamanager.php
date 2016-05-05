<?php
	/**
		 * @name: DatabaseManager
		 * @role:  manages all database transactions in PictureBase
		 * @version:  1.0.0
		 * @author:  Sigurður R Ragnarsson
		 * @since:	 22.01.2015
		 * @system:  VEF2A3U - Tækniskólinn
		 */
	class DatabaseManager
	{
		private $connection;
		
		/**
		 * The class Constructor
		 *
		 * @param string  server
		 * @param string  database
		 * @param string  user
		 * @param string  password
		 *
		 * @usage example  $db_man = new DatabaseManager('127.0.0.1','PictureBase','johndoe','12345');
		 */
		public function __construct($server,$database,$user,$password)
		{
			try
			{
				$this->connection = new PDO("mysql:host=$server;dbname=$database", $user, $password);
			}
			catch (PDOException $e)
			{
				die();
			}
		}
		
		/**
		*	@function name:  newUser
		*
		*	This function inserts a new user in the database. It 
		*	returns true if the operation succeded  or false if it didn't
		*
		* @usage example:  $db_object->newUser('John',Doe','jd@fakemail.ru','jodo','12345');
		*
		* @param  string	first_name
		* @param  string	last_name
		* @param  string	user_email
		* @param  string	user_name
		* @param  string	user_pass
		*
		* @returns boolean
		* @returns boolean
		*/
		public function newUser($first_name,$last_name,$user_email,$user_name,$user_pass)
		{
			$statement = $this->connection->prepare('call NewUser(?,?,?,?,?)');
			$statement->bindParam(1,$first_name);
			$statement->bindParam(2,$last_name);
			$statement->bindParam(3,$user_email);
			$statement->bindParam(4,$user_name);
			$statement->bindParam(5,$user_pass);
			
			try 
			{
				$statement->execute();
				
				return true;
			}
			catch(PDOException $e)
			{
				return false;
			}
		}
		
		/**
		*	@function name:  getUser
		*
		*  This function returns information about a single user in the database.
		*
		* @usage example:  $db_object->getUser(666);
		*
		* @param  int  user_id
		*
		* @returns array
		*/
		public function getUser($user_id)
		{
			$statement = $this->connection->prepare('call GetUser(?)');
			$statement->bindParam(1,$user_id);
			
			try 
			{
				$statement->execute();
				
				$row = $statement->fetch(PDO::FETCH_NUM);
				return $row;
			}
			catch(PDOException $e)
			{
				return array();
			}
		}
		
		
		/**
		*	@function name:  getUser
		*
		*	The function returns a list of currently active users 
		*
		* @usage example:	$db_object->userList();
		*
		*	@returns array
		*/
		public function userList()
		{
			$statement = $this->connection->prepare('call UserList()');
			
			try 
			{
				$arr = array();
				$statement->execute();
				
				while ($row = $statement->fetch(PDO::FETCH_NUM)) 
				{
					array_push($arr,$row);
				}
				return $arr;
			}
			catch(PDOException $e)
			{
				return array();
			}
		}
	
		/**
		*	@function name:  updateUser
		*
		*	This function updates info about a single user in the database.  
		*	It returns true if it succees otherwise false.
		*
		* @usage example:	$db_object->updateUser(999,'Jean',Doe','jd@nofakemail.vg','jeodeo','54321');
		*
		*	@param  int  userI_id
		*	@param  string  first_name
		*	@param  string  last_name
		*	@param  stirng  user_email
		*	@param  string  user_name
		*	@param  string  user_pass
		*
		*	@returns boolean
		*/
		public function updateUser($userI_id,$first_name,$last_name,$user_email,$user_name,$user_pass)
		{
			$statement = $this->connection->prepare('call UpdateUser(?,?,?,?,?,?)');
			$statement->bindParam(1,$userI_id);
			$statement->bindParam(2,$first_name);
			$statement->bindParam(3,$last_name);
			$statement->bindParam(4,$user_email);
			$statement->bindParam(5,$user_name);
			$statement->bindParam(6,$user_pass);
			
			try 
			{
				$statement->execute();
				
				return true;
			}
			catch(PDOException $e)
			{
				return false;
			}
		}
	
		/**
		*	@function name:  deleteUser
		*
		*	This function deletes a single user from the database.  
		*	TIt returns true if the delete action was successful otherwise false.
		*
		*	@usage example:	$db_object->deleteUser(999);
		*
		*	@param  int  user_id
		*
		*	@returns boolean
		*/
		public function deleteUser($user_id)
		{
			$statement = $this->connection->prepare('call DeleteUser(?)');
			$statement->bindParam(1,$user_id);
			
			try 
			{
				$statement->execute();
				
				return true;
			}
			catch(PDOException $e)
			{
				return false;
			}
		}
		
		/**
		*	@function name:  resetUser
		*
		*	The function resets a user that has been deleted.
		*	 It returns true if the reset was successful, otherwise false.
		*
		*	@usage example:	$db_object->resetUser(999);
		*
		*	@param  int  user_id
		*
		*	@returns boolean
		*/
		public function resetUser($user_id)
		{
			$statement = $this->connection->prepare('call ResetUser(?)');
			$statement->bindParam(1,$user_id);
			
			try 
			{
				$statement->execute();
				
				return true;
			}
			catch(PDOException $e)
			{
				return false;
			}
		}
		
		/**
		*	@function name:  setAccessLevel
		*
		*	This function changes the current access level of a particular user.
		*	It needs to be run by someone with administrative privileges and
		*	therefore it needs a user id from an admin.
		*  The function returns the new accesslevel if it is successful but 0 otherwise.
		*
		*	@usage example:	$db_object->setAccessLevel(2,666,1250)
		*
		*	@param  int  access_level
		*	@param  int  user_id
		*	@param  int  admin_id
		*
		*	@returns int
		*/
		public function setAccessLevel($access_level,$user_id,$admin_id)
		{
			$statement = $this->connection->prepare('select SetAccessLevel(?,?,?)');
			$statement->bindParam(1,$access_level);
			$statement->bindParam(2,$user_id);
			$statement->bindParam(3,$admin_id);
			
			try 
			{
				$statement->execute();
				$row = $statement->fetch(PDO::FETCH_NUM);
				
				return $row[0];
			}
			catch(PDOException $e)
			{
				return 0;
			}
		}

		/**
		*	@function name:  validateUser
		*
		*  This function validates the user against the database.
		*	If the username and password are found, it returns 
		*	true. If not it returns false
		*
		*	@usage example:	$db_object->validateUser('joedoe','12345');
		*
		*	@param string  user_name
		*	@param string  user_pass
		*
		*	@returns  boolean
		*/
		public function validateUser($user_name,$user_pass)
		{
			$statement = $this->connection->prepare('select ValidateUser(?,?)');
			$statement->bindParam(1,$user_name);
			$statement->bindParam(2,$user_pass);
			
			$ret = false;
			
			try 
			{
				$statement->execute();
				$row = $statement->fetch(PDO::FETCH_NUM);
				
				if($row[0] == 1)
					$ret = true;
			}
			catch(PDOException $e)
			{
				$ret = false;
			}
			
			return $ret;
		}
	
		/**
		*	@function name:  newCategory
		*
		*	The function adds a new picture category to the database.
		*	If the insert was successful true is returned otherwise fale
		*
		*	@usage example:	$db_object->newCategory('photos from Work')
		*
		*	@param  string  category_name
		*
		*	@returns  boolean
		*/
		public function newCategory($category_name)
		{
			$statement = $this->connection->prepare('call NewCategory(?)');
			$statement->bindParam(1,$category_name);
			
			try 
			{
				$statement->execute();
				
				return true;
			}
			catch(PDOException $e)
			{
				return false;
			}
		}
		
		/**
		*	@function name:  getCategory
		*
		*	This function gets a single category info from the database.
		*  If  a category is found with the supplied id the function 
		*  returns an array with that category.  Otherwise it returns
		*  an empty array
		*
		*	@usage example:	$db_object->getCategory(5)
		*
		*	@param	int  category_id
		*
		*	@returns array
		*/
		public function getCategory($category_id)
		{
			$statement = $this->connection->prepare('call GetCategory(?)');
			$statement->bindParam(1,$category_id);
			
			try 
			{
				$statement->execute();
				
				$row = $statement->fetch(PDO::FETCH_NUM);
				return $row;
			}
			catch(PDOException $e)
			{
				return array();
			}
		}
		
		/**
		*	@function name:  updateCategory
		*
		*	The function updates information about a single category.
		*	If the update is successful true is returned else false.
		*
		*	@usage example:	$db_object->updateCategory('my kids',5);
		*
		*	@param  string  category_name
		*	@param  int  category_id
		*
		*	@returns  boolean
		*/
		public function updateCategory($category_name,$category_id)
		{
			$statement = $this->connection->prepare('call UpdateCategory(?,?)');
			$statement->bindParam(1,$category_name);
			$statement->bindParam(2,$category_id);
			
			try 
			{
				$statement->execute();
				
				return true;
			}
			catch(PDOException $e)
			{
				return false;
			}
		}
		
		/**
		*	@function name:  deleteCategory
		*
		*	The function deletes a single category form the database.
		*  Successful completion results in a true value being returned
		*	and an unsuccessful attempt returns false
		*
		*	@usage example:	$db_object->deleteCategory(5);
		*
		*	@param  int  category_id
		*
		*	@returns boolean
		*/
		public function deleteCategory($category_id)
		{
			$statement = $this->connection->prepare('call DeleteCategory(?)');
			$statement->bindParam(1,$category_id);
			
			try 
			{
				$statement->execute();
				
				return true;
			}
			catch(PDOException $e)
			{
				return false;
			}
		}
		
		/**
		*	@function name:  categoryList
		*
		*	This function returns a list of all the picture categories that
		*	exists in the dtabase.  In the event that the function fails to
		*	find any categories a empty arry is returned.
		*
		*	@usage example:	$db_object->categoryList()
		*
		*	@returns  array
		*/
		public function categoryList()
		{
			$statement = $this->connection->prepare('call CategoryList()');
			
			try 
			{
				$arr = array();
				$statement->execute();
				
				while ($row = $statement->fetch(PDO::FETCH_NUM)) 
				{
					array_push($arr,$row);
				}
				return $arr;
			}
			catch(PDOException $e)
			{
				return array();
			}
		}
		
		/**
		*	@function name:  newImageInfo
		*
		*	Inserts information about a newly loaded image into the database.
		*	If it's successful true is returned otherwise false.
		*
		*	@usage example:	$db_object->newImageInfo('kisa_min_001','images/unprocessed','Flott mynd af kisu',7);
		*
		*	@param  string name
		*	@param  string path
		*	@param  string text
		*	@param  int category
		*
		*	@returns boolean
		*/
		public function newImageInfo($name,$path,$text,$category)
		{
			$statement = $this->connection->prepare('call NewImage(?,?,?,?)');
			$statement->bindParam(1,$name);
			$statement->bindParam(2,$path);
			$statement->bindParam(3,$text);
			$statement->bindParam(4,$category);
			
			try 
			{
				$statement->execute();
				
				return true;
			}
			catch(PDOException $e)
			{
				return false;
			}
		}
		
		/**
		*	@function name:  getImageInfo
		*
		*	This function returns information about a single image.
		*	In case an image with the supplied id is not found an 
		*	empty array is returned.
		*
		*	@usage example:	$db_object->getImageInfo(504);
		*
		*	@param  int  image_id
		*
		*	@returns array
		*/
		public function getImageInfo($image_id)
		{
			$statement = $this->connection->prepare('call GetImage(?)');
			$statement->bindParam(1,$image_id);
			
			try 
			{
				$statement->execute();
				
				$row = $statement->fetch(PDO::FETCH_NUM);
				return $row;
			}
			catch(PDOException $e)
			{
				return array();
			}
		}
		
		/**
		*	@function name:  updateImageInfo
		*
		*  Use this function to update information about a image in the database.
		*	Successful update means a true is returned, otherwise false.
		*
		*	@usage example:	$db_object->updateImageInfo(398,'little Kitty','images/processed','Another kisa-mín',7);
		*
		*	@param  int  id
		*	@param  string  name
		*	@param  string  path   
		*	@param  string  text  
		*	@param  string  category 
		*
		*	@returns  boolean
		*/
		public function updateImageInfo($id,$name,$path,$text,$category)
		{
			$statement = $this->connection->prepare('call UpdateImage(?,?,?,?,?)');
			$statement->bindParam(1,$id);
			$statement->bindParam(2,$name);
			$statement->bindParam(3,$path);
			$statement->bindParam(4,$text);
			$statement->bindParam(5,$category);
			
			try 
			{
				$statement->execute();
				
				return true;
			}
			catch(PDOException $e)
			{
				return false;
			}
		}
		
		/**
		*	@function name:  deleteImageInfo
		*
		*	This function deletes info about a single image.
		*	sucessful delete means a true is returned.
		*	Unsuccsessful deletion and a false is returned.
		*
		*	@usage example:	$db_object->deleteImageInfo(504);
		*
		*	@param  int  image_id
		*
		*	@returns  boolean
		*/
		public function deleteImageInfo($image_id)
		{
			$statement = $this->connection->prepare('call DeleteImage(?)');
			$statement->bindParam(1,$image_id);
			
			try 
			{
				$statement->execute();
				
				return true;
			}
			catch(PDOException $e)
			{
				return false;
			}
		}
		
		/**
		*	@function name:  imageList
		*
		*	This function returns a list if all images int the database.
		*	In the event that no images are found a empty array is returned.
		*
		*	@usage example:	$db_object->imageList();
		*
		*	@returns array.
		*/
		public function imageList()
		{
			$statement = $this->connection->prepare('call ImageList()');
			
			try 
			{
				$arr = array();
				$statement->execute();
				
				while ($row = $statement->fetch(PDO::FETCH_NUM)) 
				{
					array_push($arr,$row);
				}
				return $arr;
			}
			catch(PDOException $e)
			{
				return array();
			}
		}
	}
?>