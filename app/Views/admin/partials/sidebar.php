<?php
    $isMasterActive = in_array(current_url(true)->getSegment(2), array_column($master_menu, 'group'));
    $isTransactionActive = in_array(current_url(true)->getSegment(2), array_column($transact_menu, 'group'));
?>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="/">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link <?= $isMasterActive ? '' : 'collapsed' ?>" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Master Data</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse <?= $isMasterActive ? 'show' : '' ?>" data-bs-parent="#sidebar-nav">
                <?php foreach ($master_menu as $menu) : ?>
                    <li>
                        <a href="<?= esc($menu['link']) ?>">
                            <i class="bi bi-circle"></i><span><?= esc($menu['name']) ?></span>
                        </a>
                    </li>
                <?php endforeach ?>
            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link <?= $isTransactionActive ? '' : 'collapsed' ?>" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Transaction Data</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse <?= $isTransactionActive ? 'show' : '' ?>" data-bs-parent="#sidebar-nav">
                <?php foreach ($transact_menu as $menu) : ?>
                    <li>
                        <a href="<?= esc($menu['link']) ?>">
                            <i class="bi bi-circle"></i><span><?= esc($menu['name']) ?></span>
                        </a>
                    </li>
                <?php endforeach ?>
            </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>F.A.Q</span>
            </a>
        </li><!-- End F.A.Q Page Nav -->

    </ul>

</aside><!-- End Sidebar-->