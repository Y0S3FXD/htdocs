<div class="container" style="margin-top: 30px">
    <div class="row">
        <div class="col-md-3"> <!-- Adjust column size as needed -->
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Alle emner</a>
                </li>
                <?php
                $printedChannels = array(); // Initialize an array to store printed channel IDs

                if (count($posts) > 0) {
                    foreach ($posts as $p) {
                        // Check if this channel has already been printed
                        if (!in_array($p['channel_id'], $printedChannels)) {
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="posts.php?id=' . $p['channel_id'] . '">' . $p['name'] . '</a>';
                            echo '</li>';

                            // Add the channel ID to the printedChannels array
                            $printedChannels[] = $p['channel_id'];
                        }
                    }
                }
                ?>
            </ul>
        </div>

        <div class="col-md-9"> <!-- Adjust column size as needed -->
            <div class="row">
                <?php if (count($posts) > 0) {
                    foreach ($posts as $p) {
                        echo '<div class ="col-md-4 mb-4">'; // Adjust column size and spacing as needed
                        echo '<div class="card costum-card">';
                        if (!empty($p['img_url'])) {
                            echo '<img class="card-img-top" src="' . $p['img_url'] . '" alt="Card image cap">';
                        }
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . $p['title'] . '</h5>';
                        echo '<p class="card-text">' . $p['content'] . '</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } ?>
            </div>
        </div>
    </div>
</div>
