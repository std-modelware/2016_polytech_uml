<?php

require_once(dirname(__FILE__) . "/../OperationResult.php");
require_once(dirname(__FILE__) . "/../DataBaseManager.php");
require_once(dirname(__FILE__) . "/IAccount.php");
require_once(dirname(__FILE__) . "/ITask.php");

class Services implements IAccount, ITask
{
    private static $services = NULL;

    public static function getInstance()
    {
        if (self::$services === NULL) {
            self::$services = new Services();
        }

        return self::$services;
    }

    private function getConnection()
    {
        return DataBaseManager::GetInstance();
    }

    // IAccount
    public function getAccountByEmailAndPassword($email, $pass)
    {
        $res = new OperationResult();

        $db = null;
        try {
            $db = $this->getConnection();

            $q = $db->prepare("select id, email from account where email=:email and pass=:pass");
            $r = $q->execute(array('email' => $email, 'pass' => $pass));

            if (!$r) {
                return $res->bad("Ошибка доступа к базе данных. Повторите запрос позже");
            } else {
                return $res->good(["rows" => $q->rowCount(), "data" => $q->fetchAll(PDO::FETCH_CLASS, "Account")]);
            }

        } catch (PDOException $e) {
            return $res->bad($e->getMessage());
        }

    }

    public function checkAccountWithEmail($email)
    {
        $res = new OperationResult();

        $db = null;
        try {
            $db = $this->getConnection();

            $q = $db->prepare("select count(*) as count from account where email=:email");
            $r = $q->execute(array('email' => $email));

            if (!$r || $q->rowCount() != 1) {
                return $res->bad("Ошибка доступа к базе данных. Повторите запрос позже");
            } else {
                return $res->good(["data" => $q->fetchAll(PDO::FETCH_CLASS, "AccountChecker")]);
            }

        } catch (PDOException $e) {
            return $res->bad($e->getMessage());
        }

    }

    public function registerAccountWithEmailAndPassword($email, $pass)
    {
        $res = new OperationResult();

        $db = null;
        try {
            $db = $this->getConnection();

            $q = $db->prepare("insert into account (email, pass) values (:email, :pass)");
            $r = $q->execute(array(
                    'email' => $email,
                    'pass' => $pass
                )
            );

            if (!$r || $q->rowCount() != 1) {
                return $res->bad("Ошибка доступа к базе данных. Повторите запрос позже");
            } else {
                $registerAccout = new Account();
                $registerAccout->id = $db->lastInsertId();
                $registerAccout->email = $email;

                return $res->good([
                    "data" => $registerAccout
                ]);
            }
        } catch (PDOException $e) {
            return $res->bad($e->getMessage());
        }
    }

    public function getAccountList()
    {
        $res = new OperationResult();

        $db = null;
        try {
            $db = $this->getConnection();

            $q = $db->prepare("select id, email from account");
            $r = $q->execute();

            if (!$r) {
                return $res->bad("Ошибка доступа к базе данных. Повторите запрос позже");
            } else {
                return $res->good(["rows" => $q->rowCount(), "data" => $q->fetchAll(PDO::FETCH_CLASS, "Account")]);
            }

        } catch (PDOException $e) {
            return $res->bad($e->getMessage());
        }

    }


    // ITask
    public function createTask($tasktitle, $taskdescription, $taskdate, $taskagent, $taskauthor)
    {
        $res = new OperationResult();

        $db = null;
        try {
            $db = $this->getConnection();

            $q = $db->prepare("insert into task (title, description, date, author_id, agent_id) values (:title, :description, :taskdate, :author_id, :agent_id)");
            $r = $q->execute(array(
                    'title' => $tasktitle,
                    'description' => $taskdescription,
                    'taskdate' => $taskdate,
                    'agent_id' => $taskagent,
                    'author_id' => $taskauthor
                )
            );

            if (!$r || $q->rowCount() != 1) {
                return $res->bad("Ошибка доступа к базе данных. Повторите запрос позже");
            } else {
                return $res->good(0);
            }
        } catch (PDOException $e) {
            return $res->bad($e->getMessage());
        }
    }

    public function getTaskList($taskauthor)
    {
        $res = new OperationResult();

        $db = null;
        try {
            $db = $this->getConnection();

            $q = $db->prepare("select t.id, t.title, t.description, t.date, t.agent_id, a.email as agent_email from task t, account a where author_id = :taskauthor and t.agent_id = a.id");
            $r = $q->execute(
                array(
                    'taskauthor' => $taskauthor
                )
            );

            if (!$r) {
                return $res->bad("Ошибка доступа к базе данных. Повторите запрос позже");
            } else {
                return $res->good(["rows" => $q->rowCount(), "data" => $q->fetchAll(PDO::FETCH_CLASS, "Task")]);
            }

        } catch (PDOException $e) {
            return $res->bad($e->getMessage());
        }
    }

//
//    // IObject
//    public function getAllObjects()
//    {
//        $res = new OperationResult();
//
//        $db = null;
//        try {
//            $db = $this->getConnection();
//
//            $q = $db->prepare("select o.Id, o.Title, o.Desc, o.DescExt, o.Latitude, o.Longitude, o.IsVisible, c.Id as CategoryId, c.Name as CategoryName from Objects as o, Categories as c where o.CategoryId = c.Id");
//            $r = $q->execute();
//
//            if (!$r) {
//                return $res->bad("Ошибка доступа к базе данных. Повторите запрос позже");
//            } else {
//                return $res->good(["rows" => $q->rowCount(), "data" => $q->fetchAll(PDO::FETCH_CLASS, "Object")]);
//            }
//
//        } catch (PDOException $e) {
//            return $res->bad($e->getMessage());
//        }
//    }
//
//    public function setVisibilityForObject($objectId, $visibility)
//    {
//        $res = new OperationResult();
//
//        $db = null;
//        try {
//            $db = $this->getConnection();
//
//            $q = $db->prepare("update Objects set IsVisible = :visibility where Id = :objectId");
//            $r = $q->execute(array('visibility' => $visibility, 'objectId' => $objectId));
//
//            if (!$r || $q->rowCount() != 1) {
//                return $res->bad("Ошибка доступа к базе данных. Повторите запрос позже");
//            } else {
//                return $res->good("");
//            }
//
//        } catch (PDOException $e) {
//            return $res->bad($e->getMessage());
//        }
//    }
//
//    public function getObjectById($objectId)
//    {
//        $res = new OperationResult();
//
//        $db = null;
//        try {
//            $db = $this->getConnection();
//
//            $q = $db->prepare("select o.Id, o.Title, o.Desc, o.DescExt, o.Latitude, o.Longitude, o.IsVisible, c.Id as CategoryId, c.Name as CategoryName from Objects as o, Categories as c where o.Id = :objectId and o.CategoryId = c.Id");
//            $r = $q->execute(array("objectId" => $objectId));
//
//            if (!$r) {
//                return $res->bad("Ошибка доступа к базе данных. Повторите запрос позже");
//            } else {
//                return $res->good(["rows" => $q->rowCount(), "data" => $q->fetchAll(PDO::FETCH_CLASS, "Object")]);
//            }
//
//        } catch (PDOException $e) {
//            return $res->bad($e->getMessage());
//        }
//    }
//
//    public function saveObject($object)
//    {
//        $res = new OperationResult();
//
//        $db = null;
//        try {
//            $db = $this->getConnection();
//
//            if ($object->Id == 0) {
//                $q = $db->prepare("insert into Objects (Title, `Desc`, DescExt, Latitude, Longitude, CategoryId, IsVisible) values (:title, :desc, :descExt, :latitude, :longitude, 1, 0)");
//                $r = $q->execute(array(
//                        'title' => $object->title,
//                        'desc' => $object->desc,
//                        'descExt' => $object->descExt,
//                        'latitude' => $object->latitude,
//                        'longitude' => $object->longitude,
//                        )
//                );
//
//                if (!$r || $q->rowCount() != 1) {
//                    return $res->bad("Ошибка доступа к базе данных. Повторите запрос позже");
//                } else {
////                    return $res->good([
////                        "id" => $db->lastInsertId()
////                    ]);
//                    return $res->good("");
//                }
//
//            } else {
//                $q = $db->prepare("update Objects set Title = :title, `Desc` = :desc, DescExt = :descExt, Latitude = :latitude, Longitude = :longitude where Id = :objectId");
//                $r = $q->execute(array(
//                        'title' => $object->title,
//                        'desc' => $object->desc,
//                        'descExt' => $object->descExt,
//                        'latitude' => floatval($object->latitude),
//                        'longitude' => floatval($object->longitude),
//                        'objectId' => $object->id)
//                );
//
//                if (!$r || $q->rowCount() != 1) {
//                    return $res->bad("Ошибка доступа к базе данных. Повторите запрос позже");
//                } else {
//                    return $res->good("");
//                }
//            }
//
//        } catch (PDOException $e) {
//            return $res->bad($e->getMessage());
//        }
//    }
//
//    // ICategory
//    public function getCategories()
//    {
//        $res = new OperationResult();
//
//        $db = null;
//        try {
//            $db = $this->getConnection();
//
//            $q = $db->prepare("select Id, Title from Categories");
//            $r = $q->execute();
//
//            if (!$r) {
//                return $res->bad("Ошибка доступа к базе данных. Повторите запрос позже");
//            } else {
//                return $res->good(["rows" => $q->rowCount(), "data" => $q->fetchAll(PDO::FETCH_CLASS, "Category")]);
//            }
//
//        } catch (PDOException $e) {
//            return $res->bad($e->getMessage());
//        }
//    }

}