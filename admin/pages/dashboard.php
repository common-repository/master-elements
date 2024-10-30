<script src="<?php  echo \MasterElements::assets_url() . 'js/admin_script.js' ?>"></script>

<div class="em-outer-box">


    <div class="top-wellcome-box">
 
        <div class="header-flex">

            <h1>Welcome to <span>Master<span class="regular-font">Element</span></span></h1>

        </div>

        <div class="header-flex">

            <img src="<?php echo \MasterElements::assets_url() . 'images/logo.png' ?>" alt="Logo"/>

        </div>

    </div>


    <!--<div class="activate-box">

    <p> echo __('Master Elements Not Activated! to Unlock All Features Activate Now', 'masterelements');?>.</p>

         <div class="active-nowbtn">

         <a href="#"> echo  __('Activate Now', 'masterelements'); ?></a>

      </div>

    </div>-->


    <div class="em-tabs">

        <button onclick="showDashboardTabClass()" class="dropbtn">&#9776;
        </button> <?php echo __('', 'masterelements'); ?>

        <div id="em-tabs-btn" class="em-menu-btn">

            <button class="em-tablinks"
                    onclick="openDashboardTab('Dashboard')"><?php echo __('Dashboard', 'masterelements'); ?></button>

            <button class="em-tablinks"
                    onclick="openDashboardTab('Tutorials')"><?php echo __('Tutorials', 'masterelements'); ?></button>

            <button class="em-tablinks"
                    onclick="openDashboardTab('Feedback')"><?php echo __('Feedback', 'masterelements'); ?></button>

            <button class="em-tablinks"
                    onclick="openDashboardTab('Systep-Status')"><?php echo __('System Status', 'masterelements'); ?></button>

            <button class="em-tablinks"
                    onclick="openDashboardTab('Update')"><?php echo __('Update', 'masterelements'); ?></button>

        </div>


    </div>

    <div id="Dashboard" class="tabcontent">


        <div class="em-outer-section">


            <div class="em-col">


                <div class="em-option-boxes">


                    <figure><img src="<?php echo \MasterElements::assets_url() . 'images/need-some-help.png' ?>"
                                 alt="need help image"/></figure>

                    <h3><?php echo __('Need Some Help?', 'masterelements'); ?></h3>

                    <p><?php echo __('We would love to be of any assistance.', 'masterelements'); ?></p>

                    <div class="option-btn">

                        <a target="_blank"
                           href="https://wordpress.org/support/plugin/masterelements/"><?php echo __('Send Ticket', 'masterelements'); ?></a>


                    </div>

                </div>


            </div>


            <div class="em-col">


                <div class="em-option-boxes">


                    <figure><img src="<?php echo \MasterElements::assets_url() . 'images/documentation-img.png' ?>"
                                 alt="documenation image"/></figure>

                    <h3><?php echo __('Documentation', 'masterelements'); ?></h3>

                    <p><?php echo __('learn about any aspect of Master Elements Theme.', 'masterelements'); ?></p>

                    <div class="option-btn">

                        <a target="_blank"
                           href="https://masterelements.com/knowledgebase/"><?php echo __('Start Reading', 'masterelements'); ?></a>

 
                    </div>

                </div>

            </div>

            <div class="em-col">

                <div class="em-option-boxes">


                    <figure><img src="<?php echo \MasterElements::assets_url() . 'images/Subscription-img.png' ?>"
                                 alt="subscription image"/></figure>

                    <h3><?php echo __('Subscription', 'masterelements'); ?></h3>

                    <p><?php echo __('Get the latest changes in your inbox.', 'masterelements'); ?></p>

                    <div class="option-btn">

                        <a href="#"><?php echo __('Coming Soon', 'masterelements'); ?></a>


                    </div>


                </div>


            </div>


            <!-- EM OUTER SECTION -->

        </div>


        <!-- Dashboard Div Section end  -->

    </div>


    <div id="Customization" class="tabcontent">


        <div class="outer-section">


            <div class="col padding-0">

                <div class="option-boxes coming-soon">

                    <h2><?php echo __('Cooming Soon', 'masterelements'); ?></h2>

                </div>

            </div>


            <!-- EM OUTER SECTION -->

        </div>


        <!-- Customization div section end -->


    </div>


    <div id="Demo-Importer" class="tabcontent">


        <div class="outer-section">


            <div class="col padding-0">

                <div class="option-boxes coming-soon">

                    <h2><?php echo __('Cooming Soon', 'masterelements'); ?></h2>

                </div>

            </div>


            <!-- EM OUTER SECTION -->

        </div>


        <!-- Demo-Importer div section end -->


    </div>


    <div id="Template-Kits" class="tabcontent">


        <div class="outer-section">


            <div class="col padding-0">

                <div class="option-boxes coming-soon">

                    <h2><?php echo __('Cooming Soon', 'masterelements'); ?></h2>

                </div>

            </div>


            <!-- EM OUTER SECTION -->

        </div>


        <!-- Template-Kits div SECTION end -->


    </div>

    <div id="Plugins" class="tabcontent">

        <h2><?php echo __('Activated Plugins', 'masterelements'); ?></h2>

        <div class="outer-section">

            <?php

            $active_plugins = (array)get_option('active_plugins', array());


            if (is_multisite()) {

                $active_plugins = array_merge($active_plugins, get_site_option('active_sitewide_plugins', array()));

            }

            foreach ($active_plugins as $plugin) {

                $plugin_data = @get_plugin_data(WP_PLUGIN_DIR . '/' . $plugin);

                $dirname = dirname($plugin);

                $version_string = '';

                $network_string = '';

                if (!empty($plugin_data['Name'])) {

                    // link the plugin name to the plugin url if available

                    $plugin_name = esc_html($plugin_data['Name']);

                    if (!empty($plugin_data['PluginURI'])) {

                        $plugin_name = '<a href="' . esc_url($plugin_data['PluginURI']) . '" title="' . __('Visit plugin homepage', 'masterelements') . '" target="_blank">' . $plugin_name . '</a>';

                    }

                    ?>

                    <div class="col">


                        <div class="option-boxes">

                            <h3><?php echo $plugin_name; ?></h3>

                            <p><?php echo sprintf(_x('by %s', 'by author', 'masterelements'), $plugin_data['Author']) . ' Version &ndash; ' . esc_html($plugin_data['Version']) . $version_string . $network_string; ?></p>

                        </div>


                    </div>

                    <?php

                }

            }

            ?>

            <!-- EM OUTER SECTION -->

        </div>


        <!-- Plugins DIV  SECTION end -->


    </div>

    <div id="Tutorials" class="tabcontent">


        <div class="outer-section">


            <div class="col padding-0">

                <div class="option-boxes coming-soon">

                    <iframe width="560" height="315" src="https://www.youtube.com/embed/zU8vpi_9blc?controls=0"
                            frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>

                </div>

            </div>

            <!-- EM OUTER SECTION -->

        </div>


        <!-- Tutorials DIV  SECTION end -->


    </div>

    <div id="Systep-Status" class="tabcontent">

        <div class="section-content-box">

            <h3 class="content-title"><?php _e('Some informaition about your WordPress installation which can be helpful for debugging or monitoring your website.', 'masterelements'); ?></h3>

            <div class="status-wrapper">


                <table class="table" cellspacing="0">

                    <thead>

                    <tr>

                        <th colspan="3"><?php _e('WordPress Environment', 'masterelements'); ?></th>

                    </tr>

                    </thead>

                    <tbody>

                    <tr>

                        <td><?php _e('Home URL', 'masterelements'); ?>:</td>

                        <td></td>

                        <td><?php echo home_url(); ?></td>

                    </tr>

                    <tr>

                        <td><?php _e('Site URL', 'masterelements'); ?>:</td>

                        <td></td>

                        <td><?php echo site_url(); ?></td>

                    </tr>

                    <tr>

                        <td><?php _e('WP Version', 'masterelements'); ?>:</td>

                        <td></td>

                        <td><?php bloginfo('version'); ?></td>

                    </tr>

                    <tr>

                        <td><?php _e('WP Multisite', 'masterelements'); ?>:</td>

                        <td></td>

                        <td><?php if (is_multisite()) echo '&#10004;'; else echo '&#10005;'; ?></td>

                    </tr>

                    <tr>

                        <td><?php _e('WP Memory Limit', 'masterelements'); ?>:</td>

                        <td></td>

                        <td><?php

                            // This field need to make some changes

                            $server_memory = 0;

                            if (function_exists('ini_get')) {

                                echo(ini_get('memory_limit'));

                            }

                            ?></td>

                    </tr>

                    <tr>

                        <td><?php _e('WP Permalink', 'masterelements'); ?>:</td>

                        <td></td>

                        <td><?php echo get_option('permalink_structure'); ?></td>

                    </tr>

                    <tr>

                        <td><?php _e('WP Debug Mode', 'masterelements'); ?>:</td>

                        <td></td>

                        <td><?php if (defined('WP_DEBUG') && WP_DEBUG) echo '<mark class="yes">' . '&#10004;' . '</mark>'; else echo '<mark class="no">' . '&#10005;' . '</mark>'; ?></td>

                    </tr>

                    <tr>

                        <td><?php _e('Language', 'masterelements'); ?>:</td>

                        <td></td>

                        <td><?php echo get_locale() ?></td>

                    </tr>

                    </tbody>

                </table>


                <table class="table" cellspacing="0">

                    <thead>

                    <tr>

                        <th colspan="3"><?php _e('Server Environment', 'masterelements'); ?></th>

                    </tr>

                    </thead>

                    <tbody>

                    <tr>

                        <td><?php _e('Server Info', 'masterelements'); ?>:</td>

                        <td></td>

                        <td><?php echo esc_html($_SERVER['SERVER_SOFTWARE']); ?></td>

                    </tr>

                    <tr>

                        <td><?php _e('PHP Version', 'masterelements'); ?>:</td>

                        <td></td>

                        <td><?php

                            // should add the cpmparsion check for version_compare(PHP_VERSION, '5.0.0', '<')

                            if (function_exists('phpversion')) echo esc_html(phpversion()); ?></td>

                    </tr>

                    <tr>

                        <td><?php _e('Server Info', 'masterelements'); ?>:</td>

                        <td></td>

                        <td><?php echo esc_html($_SERVER['SERVER_SOFTWARE']); ?></td>

                    </tr>

                    <?php if (function_exists('ini_get')) : ?>

                        <tr>

                            <td><?php _e('PHP Post Max Size', 'masterelements'); ?>:</td>

                            <td></td>

                            <td></td>

                        </tr>

                        <tr>

                            <td><?php _e('PHP Time Limit', 'masterelements'); ?>:</td>

                            <td></td>

                            <td><?php

                                $time_limit = ini_get('max_execution_time');

                                //should add the condition

                                if ($time_limit < 60 && $time_limit != 0) {

                                    echo '<mark class="server-status-error">' . sprintf(__('%s - We recommend setting max execution time to at least 60. See: <a href="%s" target="_blank">Increasing max execution to PHP</a>', 'masterelements'), $time_limit, 'http://codex.wordpress.org/Common_WordPress_Errors#Maximum_execution_time_exceeded') . '</mark>';

                                } else {

                                    echo '<mark class="yes">' . $time_limit . '</mark>';

                                }

                                ?>

                            </td>

                        </tr>

                        <tr>

                            <td><?php _e('PHP Max Input Vars', 'masterelements'); ?>:</td>

                            <td></td>

                            <td><?php echo ini_get('max_input_vars'); ?></td>

                        </tr>

                        <tr>

                            <td><?php _e('SUHOSIN Installed', 'masterelements'); ?>:</td>

                            <td></td>

                            <td><?php echo extension_loaded('suhosin') ? '&#10004;' : '&#10005;'; ?></td>

                        </tr>

                    <?php endif; ?>

                    <tr>

                        <td><?php _e('MySQL Version', 'masterelements'); ?>:</td>

                        <td></td>

                        <?php

                        /** @global wpdb $wpdb */

                        global $wpdb;

                        //  $DB = $wpdb->db_version();

                        //echo $DB;

                        _e($wpdb->db_version(), 'masterelements');

                        ?>

                        </td>

                    </tr>

                    <tr>

                        <td><?php _e('Max Upload Size', 'masterelements'); ?>:</td>

                        <td></td>

                        <td><?php echo size_format(wp_max_upload_size()); ?></td>

                    </tr>

                    <tr>

                        <td><?php _e('Default Timezone is UTC', 'masterelements'); ?>:</td>

                        <td></td>

                        <td><?php

                            $default_timezone = date_default_timezone_get();

                            if ('UTC' !== $default_timezone) {

                                echo '<mark class="server-status-error">' . '&#10005; ' . sprintf(__('Default timezone is %s - it should be UTC', 'masterelements'), $default_timezone) . '</mark>';

                            } else {

                                echo '<mark class="yes">' . '&#10004;' . '</mark>';

                            } ?>

                        </td>

                    </tr>

                    </tbody>

                </table>

            </div>

        </div>

        <!-- Status update DIV  SECTION end -->


    </div>

    <div id="Update" class="tabcontent">


        <div class="outer-section">


            <div class="col padding-0">

                <div class="option-boxes coming-soon">

                    <h2 class="already-update-plugin"><?php echo __('Master Elements is Upto date.', 'masterelements'); ?></h2>

                    <h2 class="update-plugin-required"
                        style="display:none;"><?php echo __('A new version of Master Elements is available ', 'masterelements'); ?>
                        <a class="update-now" type="button"
                           href="#"><?php echo __('Update now', 'masterelements'); ?></a></h2>

                </div>

            </div>


            <!-- EM OUTER SECTION -->

        </div>


        <!-- Updates DIV  SECTION end -->


    </div>

    <div id="Feedback" class="tabcontent">


        <div class="outer-section">

            <div class="log-badge">

                <div class="feedback_container">
                    <label for="fname">Name</label>
                    <input type="text" id="name" name="name" placeholder="Your Name">

                    <label for="lname">Email</label>
                    <input type="email" id="email" name="email" placeholder="Your Email">

                    <label for="lname">Website</label>
                    <input type="text" id="website" name="website" placeholder="Your website">

                    <label for="subject">Comment</label>
                    <textarea id="comment" name="comment" placeholder="Write something.."
                              style="height:200px"></textarea>

                    <div class="option-btn">
                        <a id="sendFeedback" href="javascript:void(0)">Send
                            Feedback</a>
                    </div>
                </div>

                <!-- LOG BADGE -->

            </div>


            <div class="em-version-message em-version-screen2" style="display: none;">

                <?php

                $filename = ME_Path . "/changelog.txt";

                $fp = fopen($filename, 'r');


                // Add each line to an array

                if ($fp) {

                    $fcontent = explode("\n", fread($fp, filesize($filename)));

                }

                $i = 1;

                $j = 1;

                foreach ($fcontent as $str) {

                    //echo strcmp($str,'end');

                    if ($i == 1) {

                        echo '<div class="em-version-message em-version-screen2">

				<div class="em-versioninner-box"> 

				<ul class="parent-ul">

				<div>' . $str . '</div>';

                    } elseif ($i == 2) {

                        $st = explode(' ', $str);

                        echo '<div><span class="version">Version</span>' . $st[1] . '</div>';

                    } else {

                        echo '<li>

				<ul class="child-ul">';

                        if (strpos($str, "[New]") !== false) {

                            $str = str_replace("[New]", "", $str);

                            echo '<li><span class="change">Changed</span>' . $str . '</li>';

                        } elseif (strpos($str, "[Update]") !== false) {

                            $str = str_replace("[Update]", "", $str);

                            echo '<li><span class="improve">Improved Style</span>' . $str . '</li>';

                        } elseif (strpos($str, "[Fix]") !== false) {

                            $str = str_replace("[Fix]", "", $str);

                            echo '<li><span class="bug">Bug</span>' . $str . '</li>';

                        }

                        $i++;

                    }

                }

                echo '</div></div>'

                ?>

            </div>

            <!-- EM OUTER SECTION -->

        </div>


        <!-- Feedback DIV  SECTION end -->


    </div>


</div>

<script>

    function openCity(evt, cityName) {

        var i, tabcontent, tablinks;

        tabcontent = document.getElementsByClassName("tabcontent");

        for (i = 0; i < tabcontent.length; i++) {

            tabcontent[i].style.display = "none";

        }

        tablinks = document.getElementsByClassName("em-tablinks");

        for (i = 0; i < tablinks.length; i++) {

            tablinks[i].className = tablinks[i].className.replace(" active", "");

        }

        document.getElementById(cityName).style.display = "block";

        evt.currentTarget.className += " active";

    }


    function myFunction() {

        document.getElementById("em-tabs-btn").classList.toggle("show");

    }


    window.onclick = function (event) {

        if (!event.target.matches('.em-dropbtn')) {

            var dropdowns = document.getElementsByClassName("em-menu-btn");

            var i;

            for (i = 0; i < dropdowns.length; i++) {

                var openDropdown = dropdowns[i];

                if (openDropdown.classList.contains('show')) {

                    openDropdown.classList.remove('show');

                }

            }

        }

    }


</script>

