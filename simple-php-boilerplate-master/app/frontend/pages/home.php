<div class="container" style="margin-top:30px">
    <div class="row">
      <div class="col-sm-4">
        <ul class="nav nav-pills flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="#">Alle emner</a>
          </li>
          <li class="nav-item">
        <?php  if ($channels->count()) {
                foreach ($channels->results() as $channel) {
                    echo '<div class="card text-center">';
                    echo '<div class="card-body">';
                    echo '<h4 class="card-title text-center">' . $channel->name . '</h4>';
                    echo '<p class="card-text">' . $channel->description . '</p>';
                    echo '<a href="posts.php?id=' . $channel->channel_id . '" class="btn btn-primary ">View Channel</a>';
                    echo '</div>';
                    echo '</div>';
                }}
                ?>
          </li>
        </ul>
      </div>
        <hr class="d-sm-none">
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