<?php
/**
 * Created by PhpStorm.
 * User: sv
 * Date: 30.11.18
 * Time: 20:38
 */

namespace App\Add;

use App\Model\DbConfigModel;
use Medoo\Medoo;

/**
 * Class Db
 *
 * @package App\Add
 */
class Db extends Medoo
{
    /** @var array */
    protected $err = [];

    /**
     * Db constructor.
     *
     * @param DbConfigModel $dbConfigModel
     */
    public function __construct(DbConfigModel $dbConfigModel)
    {
        try {;
            $cdb = $dbConfigModel;
            parent::__construct(
                [
                    'database_type' => $cdb->getDatabaseType(),
                    'database_name' => $cdb->getDatabaseName(),
                    'server'        => $cdb->getServer(),
                    'username'      => $cdb->getUsername(),
                    'password'      => $cdb->getPassword(),
                    'charset'       => $cdb->getCharset()
                ]
            );
        } catch (\Exception $e) {
            echo "fatal error database: " . $e->getMessage();
            die;
        }
    }

    /**
     * @return bool
     */
    public function debug()
    {
        $err = $this->error();

        if ($err[1] != null || $err[2] != null) {
            $res = true;
            $this->err = [
                'err' => $err,
                'log' => $this->log()
            ];
        } else {
            $res = false;
            $this->err = [];
        }

        return $res;
    }

    /**
     * @return array
     */
    public function getError()
    {
        return $this->err;
    }

    public function rollBack()
    {
        $this->pdo->rollBack();
    }

    public function commit()
    {
        $this->pdo->commit();
    }

    public function beginTransaction()
    {
        $this->pdo->beginTransaction();
    }

    public function setAutoCommitUp()
    {
        $this->query('SET AUTOCOMMIT=1;');
    }

    public function setAutoCommitDown()
    {
        $this->query('SET AUTOCOMMIT=0;');
    }
}
