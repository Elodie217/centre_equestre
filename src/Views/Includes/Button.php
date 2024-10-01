<?php
class Button
{
    private $label;
    private $type;
    private $onClick;

    public function __construct($label, $onClick = '', $type = 'button')
    {
        $this->label = $label;
        $this->type = $type;
        $this->onClick = $onClick;
    }

    public function create_a()
    {
        return '<a type="' . $this->type . '" class="text-white hover:bg-gray-50 border-b border-gray-100 bg-[#895B1E] hover:bg-[#A16C21] rounded-xl md:border-0 block pl-3 pr-4 py-2 md:py-2 md:px-4 w-fit" href="' . $this->onClick . '">' . $this->label . '</a>';
    }

    public function create_btn()
    {
        return '<button type="' . $this->type . '" class="text-white hover:bg-gray-50 border-b border-gray-100 bg-[#895B1E] hover:bg-[#A16C21] rounded-xl md:border-0 block pl-3 pr-4 py-2 md:py-2 md:px-4 w-fit" onclick="' . $this->onClick . '">' . $this->label . '</button>';
    }
}
