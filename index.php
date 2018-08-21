<? include($_SERVER["DOCUMENT_ROOT"] . '/bitrix/header.php'); ?>
<?

use Bitrix\Main\Application;

$request = Application::getInstance()->getContext()->getRequest();
$isGridAjaxRequest = (
    $request->isAjaxRequest()
    && \Bitrix\Main\Grid\Context::isInternalRequest()
    && $_REQUEST['grid_id'] === 'grid1'
);

if ($isGridAjaxRequest) {
    $arRows = [
        [
            'data' => [
                'ID' => 2,
                'NAME' => 'Level 2',
            ],
            'actions' => [],
            'columns' => [
                'NAME' => 'Level 2'
            ],
            'editable' => false,
            'parent_id' => 1,
            'has_child' => false,
        ],
    ];
} else {
    $arRows = [
        [
            'data' => [
                'ID' => 1,
                'NAME' => 'Level 1',
            ],
            'actions' => [],
            'columns' => [
                'NAME' => 'Level 1'
            ],
            'editable' => false,
            'parent_id' => 0,
            'has_child' => true,
        ],
    ];
}

if ($isGridAjaxRequest)
    $APPLICATION->RestartBuffer();

$APPLICATION->IncludeComponent("bitrix:main.ui.grid", "", [
    'GRID_ID' => 'grid1',
    'AJAX_MODE' => 'Y',
    'AJAX_ID' => \CAjax::getComponentID('bitrix:main.ui.grid', '.default', ''),
    'ENABLE_COLLAPSIBLE_ROWS' => true,

    'COLUMNS' => [
        ['id' => 'ID', 'name' => 'ID', 'sort' => 'id', 'default' => false],
        ['id' => 'NAME', 'name' => 'NAME', 'sort' => 'name', 'default' => true, 'shift' => true],
    ],
    'ROWS' => $arRows,
]);
if ($isGridAjaxRequest)
    die();
?>
<? include($_SERVER["DOCUMENT_ROOT"] . '/bitrix/footer.php'); ?>
