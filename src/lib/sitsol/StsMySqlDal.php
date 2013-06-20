<?php
/* **************************************************************************************************************************************************
 * 
 *
 *  Copyright (C) 2010 by Kristof Houwen, 8800 Roeselare.
 *  All rights reserved.
 *
 *  This source code is the proprietary confidential property of Kristof Houwen, and is provided to licensee solely for documentation and
 *  educational purposes. Reproduction, publication, or distribution in any form to any party other than the licensee is strictly prohibited.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF
 *  MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES
 *  WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF
 *  OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFTWARE.
 *
 *  Author:		Kristof Houwen
 *  Company:    SitSol webdesign
 *  E-mail:		kristof(at)sitsol.be
 *  Url:		www.sitsol.be
 * 
 *  Project:    SitSol internal framework
 *  Version:	0.1             10/11/
 *
 * *****************************************************************************************************************************************************
 *
 *  Description
 *
 *  Deze klasse zorgt voor de afhandeling van alle database operaties via  PDO verbinding.  Met behulp van een ModelFactory makzen we een nieuwe
 *  model aan om PDO een binding te laten doen op deze model.
 *
 *
 * *****************************************************************************************************************************************************/

class StsMySqlDal {
   private static $conn = null;

   public static function  setConn($host, $db, $user, $pwd) {
        if (self::$conn == null) {
            try {
                self::$conn = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
            } catch (PDOException $e) {
                throw $e;
            }
        }
    }

   public static function getSqlPDOStatement($sqlQry)
   {
       if (self::$conn != null) {
            try {
                return self::$conn->prepare($sqlQry);
            } catch (PDOException $e) {
                throw $e;
            }
        }
        return null;
   }

   public static function createParameter($name, $value, &$stmt)
   {
       return $stmt->bindParam(':' . $name, $value);
   }

   public static function getList($model, &$stmt)
   {
       if (is_null($stmt))
           return null;

       $mapper = MapperFactory::getMapper($model);
       $result = array();
       $stmt->execute();
       $stmt->setFetchMode(PDO::FETCH_ASSOC);
       if ($stmt->rowCount() != 0) {
           try {
               while($r = $stmt->fetch()){
                   $dto = $mapper->getObject($r);
                   array_push($result, $dto);
               }
           } catch (PDOException $e) {
                throw $e;
           }
           return $result;
       }
       return null;
   }

   public static function getSingle($model, &$stmt)
   {
       if (is_null($stmt))
           return null;
       $mapper = MapperFactory::getMapper($model);
       $stmt->execute();
       $stmt->setFetchMode(PDO::FETCH_ASSOC);
       if ($stmt->rowCount() == 1)
       {
           try {
                $r = $stmt->fetchAll();
                return $mapper->getObject($r[0]);
           } catch (PDOException $e) {
                throw $e;
               ;
           }
        }

       return null;
   }

   public static function getFirstResult(&$stmt, $colName)
   {
       if (is_null($stmt))
           return null;

       $stmt->execute();
       $stmt->setFetchMode(PDO::FETCH_ASSOC);
       if ($stmt->rowCount() != 0)
       {
           try {
                $r = $stmt->fetch();
                return $r[$colName];
           } catch (PDOException $e) {
                throw $e;
           }
        }

       return null;
   }

   public static function executeNonquery(&$stmt)
   {
       if (is_null($stmt))
           return 0;
       $id = 0;
       try {
            self::$conn->beginTransaction();
            $stmt->execute();
            $id = self::$conn->lastInsertId();
            self::$conn->commit();
        } catch(PDOExecption $e) {
            self::$conn->rollBack();
            $id = 0;
            throw $e;
        }
        return $id;
   }

}


?>
