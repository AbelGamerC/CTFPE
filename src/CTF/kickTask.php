<?php
namespace CTF;

use pocketmine\scheduler\PluginTask;
use pocketmine\plugin\Plugin;
use pocketmine\Player;

class kickTask extends PluginTask{
	public $player;
	public function __construct(Plugin $owner, Player $player){
		parent::__construct($owner);
		$this->player = $player;
		 $config = $this->getOwner()->getConfig();
	}
	
	
	public function onRun($currentTick){
		if($this->player instanceof Player){
			if(in_array($this->player->getName(), $this->getOwner()->kick)){
				unset($this->getOwner()->compass[$id]);
				$this->player->close("","You have been kicked!");
				}
	}
}
}
