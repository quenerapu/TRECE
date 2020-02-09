<?php if(!defined("TRECE")):header("location:./");die();endif; ?>


</main>

<footer class="main-footer">

  <div class="container">

    <div class="row">

      <div class="column">

        <div class="left-block">

          <div class="logo">

            <img class="logo" src="<?=
              file_exists($conf["dir"]["images"]."logo.svg") ?
              $conf["dir"]["images"]."logo.svg?".time() :
              (file_exists($conf["dir"]["images"]."logo.png") ?
              $conf["dir"]["images"]."logo.png?".time() :
              "data:image/svg+xml;base64,".str_replace("[COLOR]",$conf["trece"]["logo"]["white"],$conf["trece"]["logo"]["img"]))
              ;?>" alt="<?=$conf["meta"]["title"][LANG];?>">

          </div>


          <div class="container">

            <div class="row">

              <div class="column">

                <h3>Reprehenderit nostrud laboris mollit Reprehenderit nostrud laboris mollit</h3>
                <p>Reprehenderit nostrud laboris mollit esse aliqua id nostrud laboris nulla dolor sint cupidatat aute exercitation in nostrud velit fugiat quis adipisicing reprehenderit adipisicing consequat esse tempor occaecat id consequat quis occaecat.</p>

                <figure>
                  <img src="https://placekitten.com/666/666" alt="Image alt text">
                  <figcaption>Here is a caption for this image.</figcaption>
                </figure>

                <h3>Reprehenderit nostrud laboris mollit Reprehenderit nostrud laboris mollit</h3>
                <p>Reprehenderit nostrud laboris mollit esse aliqua id nostrud laboris nulla dolor sint cupidatat aute exercitation in nostrud velit fugiat quis adipisicing reprehenderit adipisicing consequat esse tempor occaecat id consequat quis occaecat.</p>

              </div>

            </div>

          </div>

        </div>

        <div class="right-block">

          <div class="container">

            <div class="row">

              <div class="column">

                <figure>
                  <img src="https://placekitten.com/666/666" alt="Image alt text">
                  <figcaption>Here is a caption for this image.</figcaption>
                </figure>

                <h3>Sit nisi fugiat qui ea sint dolor</h3>
                <p>Sit nisi fugiat qui ea sint dolor ex reprehenderit elit aute reprehenderit occaecat minim in. Eu aliquip commodo voluptate laboris voluptate exercitation tempor aute enim et adipisicing aute consectetur eiusmod voluptate excepteur excepteur eu.</p>

                <h3>Sit nisi fugiat qui ea sint dolor</h3>
                <p>Sit nisi fugiat qui ea sint dolor ex reprehenderit elit aute reprehenderit occaecat minim in. Eu aliquip commodo voluptate laboris voluptate exercitation tempor aute enim et adipisicing aute consectetur eiusmod voluptate excepteur excepteur eu.</p>

              </div>

              <div class="column">

                <h3>Aliquip commodo aliquip tempor tempor</h3>
                <p>Aliquip commodo aliquip tempor tempor in duis do eiusmod magna sunt amet eu exercitation cupidatat reprehenderit laboris. Incididunt in anim sit proident labore aliquip pariatur nostrud proident sed cupidatat eu quis non officia sunt.</p>

                <h3>Incididunt in anim sit proident</h3>
                <table>
                  <thead>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="float-left">
                          <img src="https://placekitten.com/666/666" class="float-image float-image-left" style="max-width:100px;" alt="Image alt text">
                        </div>
                        <p>Lorem ipsum aliqua laboris tempor reprehenderit occaecat anim irure in laborum labore id ut consectetur exercitation mollit in id minim. Laborum mollit in amet nulla duis cillum duis ut eu incididunt dolore id excepteur ut proident aliquip minim dolor.</p>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="float-left">
                          <img src="https://placekitten.com/666/666" class="float-image float-image-left" style="max-width:100px;" alt="Image alt text">
                        </div>
                        <p>Lorem ipsum aliqua laboris tempor reprehenderit occaecat anim irure in laborum labore id ut consectetur exercitation mollit in id minim. Laborum mollit in amet nulla duis cillum duis ut eu incididunt dolore id excepteur ut proident aliquip minim dolor.</p>
                      </td>
                    </tr>
                  </tbody>
                </table>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

</footer>



<footer class="legal bottom-footer">

  <div class="container">

    <div class="row">

      <div class="column">

        <p class="text-center">
          <small>
              <i class="fas fa-balance-scale"></i> <a href="#">Legal stuff 1</a>
            | <i class="fas fa-cookie-bite"></i> <a href="#">Legal stuff 2</a>
            | <i class="fas fa-users-cog"></i> <a href="#">Legal stuff 3</a>
            | <i class="far fa-envelope"></i> <a href="#">Contact</a>
          </small>
        </p>

      </div>

    </div>

  </div>

</footer>



<footer class="poweredby bottom-footer">

  <div class="container">

    <div class="row">

      <div class="column">

        <p class="text-center"><small>Powered by <a href="https://<?=$conf["trece"]["flavour"];?>trece.boa.gal"><?=$conf["trece"]["flavour"];?>TRECE</a> with the <a href="https://<?=$conf["trece"]["flavour"];?>trece.boa.gal/themes/milligram"><?=$conf["trece"]["flavour"];?>Milligram Theme</a>.</small></p>

      </div>

    </div>

  </div>

</footer>

<?=BEGRATEFUL;?>



<?php /*
<code>

  <!-- uilang.js stuff -->

  clicking on ".hide" adds class "hidden" on "div"
  clicking on "nav .tabs" adds class "active" on "target"
  clicking on "img:first-child" toggles class "big" on "target"

</code>
*/ ?>

</body>
</html>
