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
                    </div>

                    <div class="columns">
                        <div class="column">
                            <b-field label="Middle Name">
                                <b-input type="text" placeholder="Last Name"></b-input>
                            </b-field>
                        </div>
                        <div class="column">
                            <b-field label="TEST">
                                <b-input type="text" placeholder="TEST"></b-input>
                            </b-field>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>


    <div>
    <script>

    </script>
</body>
</html>
<?php /**PATH C:\Users\Administrator\Desktop\Projects\fastgrade\resources\views/student/student-profile.blade.php ENDPATH**/ ?>