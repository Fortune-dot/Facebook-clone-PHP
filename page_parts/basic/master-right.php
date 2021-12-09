<?php

use classes\Config;
use models\UserRelation;
use layouts\master_right\Right as MasterRightComponents;

$search_url = Config::get("root/path") . "search.php";

?>

<div id="master-right" class="container">
    <style>
        #master-right{
        background-color:white!important;
          }

        /* On screens that are 992px or less, set the background color to blue */
        @media screen and (max-width: 992px) {
        #master-right{
            display: none !important;
        }
        }

        /* On screens that are 600px or less, set the background color to olive */
        @media screen and (max-width: 600px) {
        #master-right{
        display: block !important;
        }
        }
    </style>
    <div class="flex-space relative">
        <h3 class="title-style-2">Contacts</h3>
        <div>
            <a href="" id="contact-search"></a>
        </div>
        <div class="absolute" id="contact-search-field-container" class="container">
            <input type="text" id="contact-search-field" placeholder="Search by friend or group ..">
            <a class="not-link" href=""><img src="public/assets/images/icons/close.png" id="close-contact-search" class="image-style-4" alt="" height="20px"></a>
        </div>
    </div>
    <div id="contacts-container">
        <?php
            $user_relation = new UserRelation();
            $friends = $user_relation->get_friends($current_user_id);

            if(empty($friends)) {
                echo <<<EMPTY
                    <div class="flex-column" style="margin-top: 40px">
                        <img src="public/assets/images/icons/search-icon.png" alt="" style="height: 40px; width: 40px; margin: 0 auto;">
                        <p style="text-align: center" style="color: white" >Try to add your friends, follow celebrities ..</p>
                        <p style="text-align: center">click <a href="$search_url" class="link" style="color:blue">here</a> to go to the search page</p>
                    </div>
EMPTY;      
            } else {
                $master_right = new MasterRightComponents();
                foreach($friends as $friend) {
                    $master_right->generateFriendContact($current_user_id, $friend);
                }
            }

        ?>

    </div>
</div>
