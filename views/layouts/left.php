<!-- start main-sidebar -->
<aside class="main-sidebar">
    <!-- start sidebar -->
    <section class="sidebar">
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Main Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Books', 'icon' => 'file-code-o', 'url' => ['/book']],
                    ['label' => 'Documents', 'icon' => 'file-code-o', 'url' => ['/document']],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                ],
            ]
        ) ?>
    </section>
    <!-- end sidebar -->
</aside>
<!-- end main-sidebar -->