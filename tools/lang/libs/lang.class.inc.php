<?php
namespace YesWiki;

class Lang extends \YesWiki\Wiki
{
    function Href($method = '', $tag = '', $params = '', $htmlspchars = true)
    {
        if (!$tag = trim($tag)) {
            $tag = $this->tag;
        }
        $href = $this->config['base_url'].$this->MiniHref($method, $tag);
        if ($params) {
            $href .= ($this->config["rewrite_mode"] ? '?' : ($htmlspchars ? '&amp;' : '&')).$params;
        }
        if (isset($_GET['lang']) && $_GET['lang']!='') {
            $href .= '&lang='.$GLOBALS['prefered_language'];
        }
        
        return $href;
    }    
}
