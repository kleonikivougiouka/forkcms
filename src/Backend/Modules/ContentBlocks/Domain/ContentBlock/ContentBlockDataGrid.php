<?php

namespace Backend\Modules\ContentBlocks\Domain\ContentBlock;

use Backend\Core\Engine\DataGridDB;
use Backend\Core\Engine\TemplateModifiers;
use Backend\Core\Engine\Authentication as BackendAuthentication;
use Backend\Core\Engine\Model;
use Backend\Core\Language\Language;
use Backend\Core\Language\Locale;

/**
 * @TODO replace with a doctrine implementation of the data grid
 */
class ContentBlockDataGrid extends DataGridDB
{
    public function __construct(Locale $locale)
    {
        parent::__construct(
            'SELECT i.id, i.title, i.hidden
             FROM content_blocks AS i
             WHERE i.status = :active AND i.language = :language',
            ['active' => Status::active(), 'language' => $locale]
        );

        $this->setSortingColumns(['title']);

        // show the hidden status
        $this->addColumn('isHidden', ucfirst(Language::lbl('VisibleOnSite')), '[hidden]');
        $this->setColumnFunction([TemplateModifiers::class, 'showBool'], ['[hidden]', true], 'isHidden');

        // check if this action is allowed
        if (BackendAuthentication::isAllowedAction('ContentBlockEdit')) {
            $editUrl = Model::createURLForAction('ContentBlockEdit', null, null, ['id' => '[id]'], false);
            $this->setColumnURL('title', $editUrl);
            $this->addColumn('edit', null, Language::lbl('Edit'), $editUrl, Language::lbl('Edit'));
        }
    }

    public static function getHtml(Locale $locale): string
    {
        return (new self($locale))->getContent();
    }
}
