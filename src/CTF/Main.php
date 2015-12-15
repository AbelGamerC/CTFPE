<?php
namespace CTF;


use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\utils\Config;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageByChildEntityEvent;


class Main extends PluginBase implements Listener
{

    public function onLoad(){
       @mkdir($this->getDataFolder());
        $this->config = new Config($this->getDataFolder()."config.yml", Config::YAML, array(/*todo*/));
		$this->config->save();
        $this->getServer()->getLogger()->info("[CTF]Plugin is loading!");
     }
}
    
    public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
		$this->getServer()->getScheduler()->scheduleRepeatingTask(new gameTask($this),20);
        $this->getServer()->getLogger()->info("[CTF]Plugin has been enabled!");
											  
} 
