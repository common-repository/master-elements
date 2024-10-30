<?php $demo_data_url = 'http://demo.designingmedia.com/master-demo/';

$demo_img_url = 'http://demo.designingmedia.com/master-demo/images/';

$demo_data_listing_url = 'http://demo.designingmedia.com/master-demo/master_demo_listing.json';

$URL = $demo_data_listing_url;

if (ini_get('allow_url_fopen')) {
    
    $data = url_get_contents($URL);

} else {

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $URL);

    curl_setopt($ch, CURLOPT_TIMEOUT, 500);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_FAILONERROR, true);

    $data = curl_exec($ch);

    if (curl_error($ch)) {

        echo curl_error($ch);

        exit();

    }

    curl_close($ch);

}

$demos = json_decode($data, true); ?>


<?php 
function url_get_contents ($Url) {
    if (!function_exists('curl_init')){ 
        die('CURL is not installed!');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); //get the code of request
    curl_close($ch);

    if($httpCode == 400) 
       return 'No donuts for you.';

    if($httpCode == 200) //is ok?
       return $output;


}
?>

<div class="em-outer-section margin-bottom50">

    <div class="em-option-boxes premium-templates">

        <div class="inner-cont flex-1"><h2>Premium Template by <span>MasterElements</span></h2>

            <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis,

                ultricies nec, pellentesque eupretium quis, sem. Nulla consequat massa quis enim. </p>

            <div class="option-btn margin-right10"><a href="#">Get Started</a></div>

            <div class="option-btn"><a href="#">Learn More About TemplateKit</a></div>

        </div>

        <div class="inner-cont flex-1 text-right"><img

                    src="<?php echo \MasterElements::assets_url() . 'images/Premium-Template.png' ?>" alt=""></div>

    </div>

</div>



<div class="em-outer-section">

    <div class="em-option-boxes template-box-top">



        <div class="inner-cont upper-categories">

            <ul class="blocks_box_outer template-catgories">

                <?php
                if(!empty($demos)){ foreach ($demos as $key => $demo) { ?>

                    <li class="blocks_inner_box <?= str_replace(' ', '', $demo) ?>">

                        <a href="javascript:void(0);"><?= $demo ?></a>

                    </li>

                <?php }}else{
                    echo "<li class='blocks_inner_box'>No Templates Found</li>";
                } ?>

            </ul>

        </div>



        <div class="sub-categories active-widget-cnt">



            <div class="inner-cont">

                <ul class="me_navigation_tabs template-catgories">

                    <?php foreach ($demos as $key => $demo) { ?>

                        <li class="navigation_tabs <?= str_replace(' ', '', $demo) ?>">

                            <a href="javascript:void(0);"><?= $demo ?></a>

                        </li>

                    <?php } ?>

                </ul>

            </div>



            <div class="em-tabs">

                <div class="outer_box">

                    <ul class="showcase_outer template_pushing_div">



                    </ul>

                    <div class="load_more_outer">

                        <a href="#" class="load_more_btn">Load More</a>

                    </div>

                </div>



            </div>

        </div>



    </div>

</div>

