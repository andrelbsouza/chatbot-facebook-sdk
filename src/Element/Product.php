<?php
namespace ChatBot\Element;

class Product implements ElementInterface
{
    private $title;
    private $image_url;
    private $subtitle;
    private $default_action;
    private $buttons;

    /**
     * Product constructor.
     * @param $title
     * @param $image_url
     * @param $subtitle
     * @param $default_action
     * @param $buttons
     */
    public function __construct(string $title, ? string $image_url = null, ? string $subtitle = null, Button $default_action = null)
    {
        $this->title = $title;
        $this->image_url = $image_url;
        $this->subtitle = $subtitle;
        $this->default_action = $default_action;
    }

    public function add(Button $element){
        $this->buttons[] = $element->get();
    }

    public function get(): array
    {
        $result['title'] = $this->title;
        if(!is_null($this->image_url)) $result['image_url'] = $this->image_url;
        if(!is_null($this->subtitle)) $result['subtitle'] = $this->subtitle;
        if(!is_null($this->default_action)) {
            $default_action = $this->default_action->get();
            unset($default_action['title']);
            $result['default_action'] = $default_action;
        }
        if(!is_null($this->buttons)) $result['buttons'] = $this->buttons;

        return $result;
    }
}