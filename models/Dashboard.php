<?php

/**
 * Processing data incoming from user`s dashboard
 */
class Dashboard {

    /**
     * Return dashboard data (page name, description)
     * @param int $userId
     * @return array
     */
    public static function getDashboard($userId) {
        $db = Db::getConnection();
        $sql = "SELECT * FROM data WHERE userId = :userId";
        $result = $db->prepare($sql);
        $result->bindParam(':userId', $userId, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    /**
     * Update page name
     * @param string $pageName
     * @param int $userId
     * @return bool
     */
    public static function editPageName($pageName, $userId) {
        $db = Db::getConnection();
        $sql = "UPDATE data SET pageName = :pageName WHERE userId = :userId";
        $result = $db->prepare($sql);
        $result->bindParam(':pageName', $pageName, PDO::PARAM_STR);
        $result->bindParam(':userId', $userId, PDO::PARAM_INT);

        return $result->execute();
    }

    /**
     * Update page description
     * @param string $pageDescription
     * @param int $userId
     * @return bool
     */
    public static function editPageDescription($pageDescription, $userId) {
        $db = Db::getConnection();
        $sql = "UPDATE data SET pageDescription = :pageDescription "
                . "WHERE userId = :userId";
        $result = $db->prepare($sql);
        $result->bindParam(':pageDescription', $pageDescription, PDO::PARAM_STR);
        $result->bindParam(':userId', $userId, PDO::PARAM_INT);

        return $result->execute();
    }

    /**
     * Return coordinates of draggable image 
     * @param int $userId
     * @return string|bool
     */
    public static function getCoord($userId) {
        $db = Db::getConnection();
        $sql = "SELECT coordinates FROM data WHERE userId = :userId";
        $result = $db->prepare($sql);
        $result->bindParam(':userId', $userId, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch()['coordinates'];
    }
    
    /**
     * Set coordinates of draggable image 
     * @param int $userId
     * @param string $coordinates
     * @return bool
     */
    public static function setCoord($userId, $coordinates) {
        $db = Db::getConnection();
        $sql = "UPDATE data SET coordinates = :coordinates WHERE userId = :userId";
        $result = $db->prepare($sql);
        $result->bindParam(':userId', $userId, PDO::PARAM_INT);
        $result->bindParam(':coordinates', $coordinates, PDO::PARAM_STR);

        return $result->execute();
    }

}
