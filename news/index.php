<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новости");
?>

<section class="press-center" data-controller="view-more">
    <header class="press-center__header">
        <h1 class="light">Новости</h1>
    </header>
    <div class="press-center__articles press-center__articles--wide-list" data-target="view-more.container">
        <?
        $arFilter = array(
            "IBLOCK_TYPE" => "news",
            "IBLOCK_ID" => "1",
            "ACTIVE" => "Y",
        );

        $arSelect = array(
            "ID",
            "NAME",
            "PREVIEW_TEXT",
            "DETAIL_TEXT",
            "DATE_ACTIVE_FROM",
            "DETAIL_PAGE_URL",
        );

        $res = CIBlockElement::GetList(
            array("DATE_ACTIVE_FROM" => "DESC"),
            $arFilter,
            false,
            array("nTopCount" => 5),
            $arSelect
        );

        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            ?>

            <article class="news news--wide">
                <div class="news__publication-info">
                    <a href="<?= $arFields["DETAIL_PAGE_URL"] ?>" class="news__link">
                        <h3 class="news__title content-block">
                            <?= $arFields["NAME"] ?>
                        </h3>
                    </a>
                    <time class="news__publication-date" datetime="<?= $arFields["DATE_ACTIVE_FROM"] ?>">
                        <?= FormatDate("j F Y", MakeTimeStamp($arFields["DATE_ACTIVE_FROM"])) ?>
                    </time>
                    <p class="news__preview-text"><?= $arFields["PREVIEW_TEXT"] ?></p>
                </div>
            </article>

            <?
        }
        ?>

    </div>
    <div class="grid-container">
        <a class="press-center__view-more button button--inverted" href="press-center.html" data-target="view-more.button"
           data-action="view-more#load">Показать более ранние материалы</a>
    </div>
</section>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>