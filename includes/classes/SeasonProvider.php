
<?php
class SeasonProvider{

    private$con,$username;
    public function __construct($con,$username)
    {
        $this->con=$con;
        $this->username=$username;
    }

    // output the seasons for a chossen id
    public function create($entity){
        $query=$this->con->prepare("SELECT * FROM videos WHERE entityId=:id
                                    AND isMovie=0 ORDER BY season, episode ASC");
        $query->bindValue(":id" ,$entity->getId());
        $query->execute();  

        $seasons=array();
        $videos=array();
        $currentSeason=null;
        
        while($row=$query->fetch(PDO::FETCH_ASSOC)){

            if( $currentSeason != null && $currentSeason !=$row["season"]){

                $seasons[]=new Season($currentSeason,$videos);
                $videos=array();

  
            }

            $currentSeason=$row["season"];
            $videos[]=new Video($this->con,$row);

        }

        if(sizeof($videos) != 0){
            $seasons[]=new Season($currentSeason,$videos);

        }

        if(sizeof($seasons) == 0){

            return;
        }

        // we will create an html tag and return it
        $seasonsHtml ="";

        foreach($seasons as $value){
            $seasonNumber= $value->getSeasonNumber();

            $seasonsHtml .= "<div class='season'>
                                <h3> Season  $seasonNumber </h3>
                                </div>";


        }

        return $seasonsHtml;

    }



    












}
?>