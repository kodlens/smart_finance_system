<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

    <!-- Fonts -->



    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">


    
    

</head>
<body>
    <div id="app">

        <div class="columns is-centered">
            <div class="column is-10">
                <div class="box">

                    <div class="columns">
                        <div class="column">
                            <b-field label="Last Name">
                                <b-input type="text" placeholder="Last Name"></b-input>
                            </b-field>
                        </div>
                        <div class="column">
                            <b-field label="First Name">
                                <b-input type="text" placeholder="First Name"></b-input>
                            </b-field>
                        </div>
                        <div class="column">
                            <b-field label="First Name">
                                <b-input type="text" placeholder="First Name"></b-input>
                            </b-field>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="column">
                            <b-field label="Middle Name">
                                <b-input type="text" placeholder="Last Name"></b-input>
                            </b-field>
                        </div>
                        <div class="column">
                            <b-field label="TEST">
                                <b-select type="text" placeholder="TEST">
                                    <option value="MALE">MALE</option>
                                    <option value="FEMALE">FEMALE</option>
                                </b-select>
                            </b-field>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="section">

            <div class="columns is-centered">
                <div class="column is-4">
                    <div class="card">
                        <div class="card-image">
                          <figure class="image is-4by3">
                            <img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image">
                          </figure>
                        </div>
                        <div class="card-content">
                          <div class="media">
                            <div class="media-left">
                              <figure class="image is-48x48">
                                <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                              </figure>
                            </div>
                            <div class="media-content">
                              <p class="title is-4">John Smith</p>
                              <p class="subtitle is-6">@johnsmith</p>
                            </div>
                          </div>
                      
                          <div class="content">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Phasellus nec iaculis mauris. <a>@bulmaio</a>.
                            <a href="#">#css</a> <a href="#">#responsive</a>
                            <br>
                            <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
                          </div>
                        </div>
                      </div> <!--card-->
                </div> <!--col -->

                <div class="column is-4">
                    <div class="card">
                        <div class="card-image">
                          <figure class="image is-4by3">
                            <img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image">
                          </figure>
                        </div>
                        <div class="card-content">
                          <div class="media">
                            <div class="media-left">
                              <figure class="image is-48x48">
                                <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                              </figure>
                            </div>
                            <div class="media-content">
                              <p class="title is-4">John Smith</p>
                              <p class="subtitle is-6">@johnsmith</p>
                            </div>
                          </div>
                      
                          <div class="content">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Phasellus nec iaculis mauris. <a>@bulmaio</a>.
                            <a href="#">#css</a> <a href="#">#responsive</a>
                            <br>
                            <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
                          </div>
                        </div>
                      </div> <!--card-->
                </div> <!--col -->


            </div> <!--close cols -->

            

        </div>


    <div><!--root -->
    <script>

    </script>
</body>
</html>
<?php /**PATH C:\Users\eshen\Desktop\Github\fastgrade\resources\views/student/student-profile.blade.php ENDPATH**/ ?>