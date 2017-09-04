<?php

namespace Metrique\Building\Repositories\Page;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Metrique\Building\Repositories\Contracts\Page\ContentRepositoryInterface;
use Metrique\Building\Repositories\Traits\CacheBust;
use Metrique\Building\Eloquent\Page\Group;
use Metrique\Building\Eloquent\Page\Content;
use Metrique\Building\Repositories\Page\ContentRepository;
use Stringy\Stringy;

class ContentRepositoryCached extends ContentRepository implements ContentRepositoryInterface
{
    use CacheBust;

    /**
     * Persist single component item to database.
     *
     * @return bool
     */
    protected function persist(Collection $content, $pageId, $sectionId)
    {
        parent::persist($content, $pageId, $sectionId);
        
        return $this->cacheBust((int)$pageId);
    }
}
