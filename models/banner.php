<?php
class Banner extends Db
{
    public function getAllBanner()
    {
        $sql = self::$connection->prepare("SELECT * FROM banner");
        $sql->execute(); //return an object
        $banners = array();
        $banners = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $banners; //return an array
    }
}
