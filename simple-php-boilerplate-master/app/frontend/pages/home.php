<div class="container" style="margin-top:30px">
  <div class="row">
    <?php if ($posts->count()) {
      foreach ($posts->results() as $p) {

        echo '<div class ="card">';

        echo '<div class ="card" style="width: 18rem;">';
        echo '<img class="card-img-top" src="https://picsum.photos/536/354" alt="Card image cap">';
        echo '<div class="card-body">';
        echo  ' <h2>' . $p->title . ' </h2>';
        echo '      <p>' . $p->content . ' </p>';
        echo ' </div>';
        echo ' </div>';

        echo ' </div>';;
      }
    } ?>
  </div>