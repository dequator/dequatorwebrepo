<?php
class Records
{
	public $location = null;
	public $screenshot = null;
	public $text = null;
	public $curtime = null;
	public function __construct($loc, $scrshot, $txt, $ttime)
	{
		$this->location = $loc;
		$this->screenshot = $scrshot;
		$this->text = $txt;
		$this->curtime = $ttime;
	}	
	public function getLocation()
	{
		return $this->location;
	}
	public function getPhotoBASE64($getFull = true)	
	{
		if($getFull)
		{
			return $this->screenshot;
		}
		else
		{
			preg_match('/^(data:\s*image\/(\w+);base64,)/', $this->screenshot, $result);	
			$imgContent = str_replace($result[0], '', $this->screenshot);
			$imgContent = str_replace(' ' , '+', $imgContent);
			return $imgContent;
		}
	}	
	public function getPhoto()
	{
		return base64_decode($this->getPhotoBASE64(false));
	}	
};
//require('lib/aws.phar');
require('lib\aws\aws-autoloader.php');//for better debug inside AWS PHP SDK code
class RecordsStore
{
	private static $dbAccessKeyFile = "lib/DB_AccessKey.txt"; // {"key":"XXXXXXXXX", "secret":"XXXXXXXXXXXXXXXXXXXXXXXXXX"}
	public static $sdk;
	public static $dynamodb;
	public static $tableName = 'myfootpathrecords';
	
	public static function createTable()
	{
		$successful = false;
		if(self::createConn())
		{
			$found = false;
			$response = self::$dynamodb->listTables();
			foreach ($response['TableNames'] as $key => $value) {
				if($value == self::$tableName)
				{
					$found = true;
					break;
				}
			}
			if(!$found)
			{
				echo "TableNmae=".self::$tableName;
				$result = self::$dynamodb->createTable([
				'TableName' => self::$tableName,
				'AttributeDefinitions' => [
					[ 'AttributeName' => 'ID', 'AttributeType' => 'S' ]
				],
				'KeySchema' => [
					[ 'AttributeName' => 'ID', 'KeyType' => 'HASH' ]
				],
				'ProvisionedThroughput' => [
					'ReadCapacityUnits'    => 5, 
					'WriteCapacityUnits' => 6
				]
				]);	
				
				self::$dynamodb->waitUntil('TableExists', [
				'TableName' => $tableName,
				'@waiter' => [
					'delay'       => 5,
					'maxAttempts' => 20
					]
				]);
			}
			$successful = true;
		}
		return $successful;
	}
	
	public static function createConn()
	{
		$successful = false;
		if(!isset(self::$sdk) || !isset(self::$dynamodb))
		{
			$accessKey = json_decode(file_get_contents(self::$dbAccessKeyFile));
			self::$sdk = new Aws\Sdk([
				//'endpoint'   => 'http://localhost:8000',
				'region'   => 'ap-northeast-1',
				'version'  => 'latest',
				'credentials' => [
					'key'    => $accessKey->{"key"},
					'secret' => $accessKey->{"secret"}]
				]);

			self::$dynamodb = self::$sdk->createDynamoDb();
		}
		if(isset(self::$sdk) && isset(self::$dynamodb))
			$successful = true;
		return $successful;
	}
	
	public static function store($record)
	{
		$successful = false;
		if(self::createTable())
		{
			$itemInfo = 
			['TableName' => self::$tableName,
			'Item'=> 
				[
				'ID' => ['S'=> date(DATE_ISO8601)],
				'shtime' => ['S'=> $record->curtime],
				'comment' => ['S'=> $record->text],
				'screenshot' => ['S'=> $record->screenshot],
				'location' => ['M'=>
								[
								'longitude' => ['N'=> (string)($record->location->{'longitude'})],
								'latitude' => ['N'=> (string)($record->location->{'latitude'})]
								]
							]			
				]];
			$result = self::$dynamodb->putItem($itemInfo);
			
			//print_r($result);
			$successful = true;
		}
		return $successful;
	}
};
?>