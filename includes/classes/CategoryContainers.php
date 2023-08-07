
<?php

class CategoryContainers{

    private $con,$username;

    public function __construct($con,$username)
    {
        $this->con=$con;
        $this->username=$username;

    }

    public function showAllCategories(){
        $query=$this->con->prepare("SELECT * FROM categories");
        $query->execute();
        $html="<div class='previewCategories'>";

        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $html .=$this->getCategoryHtml($row,null,true,true);

        }

        return $html."</div>";
    }


    private function getCategoryHtml($sqlData,$title,$tvShows,$movies){
        $categoryId=$sqlData["id"];
        if($title==null){
            $title=$sqlData["name"];

        }else{
            $title=$title;

        }

        if($tvShows && $movies){
            $entities=entityProvider::getEntities($this->con,$categoryId,30);

        }else if($tvShows){

            // get tvshow entities
        }else{
            // get movie entities

        }

        if(sizeof($entities) == 0){
            return;

        }

        $entitiesHtml="";
        $previewProvider=new PreviewProvider($this->con,$this->username);
        foreach($entities as $value){
            $entitiesHtml .= $previewProvider->createEntityPreviewSquare($value);

        }




        return "<div class='category>
                    <a href='category.php?id=$categoryId'>
                      <h3>$title</h3>
                      </a>

                      <div class='entities'>
                      $entitiesHtml
                      </div>
               </div>";
    }




}



?>