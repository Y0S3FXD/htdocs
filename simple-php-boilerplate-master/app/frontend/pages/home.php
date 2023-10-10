<div class="container" style="margin-top:30px">
  <div class="row">
    <?php if ($posts->count()) {
      foreach ($posts->results() as $p) {


        echo '<div class ="card" style="width: 18rem;">';
        if(!empty($p->img_url)){
          echo '<img class="card-img-top" src="'.$p->img_url.'" alt="Card image cap">';
        }
        echo '<div class="card-body">';
        echo  ' <h2>' . $p->title . ' </h2>';
        echo '      <p>' . $p->content . ' </p>';
        echo ' </div>';
        echo ' </div>';
      } 
    } ?>
  </div>