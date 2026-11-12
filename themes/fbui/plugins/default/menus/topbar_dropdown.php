<?php
$menus = $params['menu'];
$user = ossn_loggedin_user();

if ($user) {
    echo '<ul class="dropdown-menu dropdown-menu-end fbui-user-dropdown" role="menu" aria-labelledby="dropdownMenu">';
    
    // 1. Facebook-style Profile Card Header (Takes user to their profile)
    ?>
    <li class="fbui-dropdown-profile-header">
        <a href="<?php echo $user->profileURL(); ?>" class="fbui-profile-card-link">
            <img src="<?php echo $user->iconURL()->small; ?>" alt="<?php echo $user->fullname; ?>" class="fbui-dropdown-avatar" />
            <span class="fbui-dropdown-name"><?php echo $user->fullname; ?></span>
        </a>
    </li>
    <li class="fbui-dropdown-divider"></li>
    <?php

    // 2. Loop through existing OSSN menu items
    if ($menus) {
        foreach($menus as $menu) {
            foreach($menu as $link) {
                $class = "dropdown-item menu-topbar-dropdown-" . $link['name'];
                if(isset($link['class'])) {
                    $link['class'] = $class . ' ' . $link['class'];
                } else {
                    $link['class'] = $class;
                }
                unset($link['name']); 
                
                echo "<li class=\"fbui-dropdown-list-item\">" . ossn_plugin_view('output/url', $link) . "</li>";
            }
        }
    }
    
    echo "</ul>";
}
?>
<style>
/* Facebook-style Topbar Dropdown Box */
.fbui-user-dropdown {
    width: 320px;
    padding: 12px;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 12px 28px 0 rgba(0, 0, 0, 0.2), 0 2px 4px 0 rgba(0, 0, 0, 0.1);
    border: none;
    margin-top: 8px;
}

/* Profile Card Header at the top */
.fbui-dropdown-profile-header {
    list-style: none;
    margin: 0;
    padding: 0;
}

/* 1. Prevent global selectors from interfering with the profile link */
.fbui-dropdown-profile-header a::before,
.fbui-profile-card-link::before {
    content: none !important;
    display: none !important;
}

.fbui-profile-card-link {
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
    padding: 8px 10px !important;
    border-radius: 8px !important;
    text-decoration: none !important;
    background: #ffffff !important;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    transition: background 0.2s ease;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.fbui-profile-card-link:hover {
    background: #f2f2f2 !important;
}

.fbui-dropdown-avatar {
    width: 40px !important;
    height: 40px !important;
    border-radius: 50% !important;
    object-fit: cover !important;
}

/* 2. Protect the name span inside the profile card from global span rules */
.fbui-profile-card-link span.fbui-dropdown-name {
    display: inline-block !important;
    width: auto !important;
    height: auto !important;
    background: transparent !important;
    margin: 0 !important;
    padding: 0 !important;
    font-size: 15px !important;
    font-weight: 700 !important;
    color: #050505 !important;
}

/* Divider Line */
.fbui-dropdown-divider {
    height: 1px;
    background: #e4e6eb;
    margin: 8px 4px;
    list-style: none;
}

/* Dropdown Menu Items List */
.fbui-user-dropdown .fbui-dropdown-list-item {
    list-style: none;
    margin: 2px 0;
}

.fbui-user-dropdown .dropdown-item {
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
    padding: 8px 10px !important;
    border-radius: 8px !important;
    color: #050505 !important;
    font-weight: 600 !important;
    font-size: 14px !important;
    text-decoration: none !important;
    transition: background 0.2s ease;
}

.fbui-user-dropdown .dropdown-item:hover {
    background: #f2f2f2 !important;
}

/* 3. Safely turn the menu icon pseudo-element into a round gray circle */
.fbui-user-dropdown .dropdown-item::before {
    width: 36px !important;
    height: 36px !important;
    min-width: 36px !important;
    border-radius: 50% !important;
    background: #e4e6eb !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 15px !important;
    color: #050505 !important;
    margin-right: 0 !important;
    float: none !important;
    font-family: var(--fa-style-family, "Font Awesome 6 Free");
    font-weight: var(--fa-style, 900);
}

/* Neutralize global theme interference on regular icons */
.fbui-user-dropdown .dropdown-item i,
.fbui-user-dropdown .dropdown-item .ossn-icon {
    width: 36px !important;
    height: 36px !important;
    min-width: 36px !important;
    border-radius: 50% !important;
    background: #e4e6eb !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 15px !important;
    color: #050505 !important;
    margin: 0 !important;
    padding: 0 !important;
    float: none !important;
}
</style>