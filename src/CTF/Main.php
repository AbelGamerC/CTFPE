<?php
namespace CTF;


use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\utils\Config;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageByChildEntityEvent;

use pocketmine\event\player\PlayerJoinEvent;


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
		$this->redPlayers = []; //max amount is 5
		$this->bluePlayers = [];
											  
} 


public function addRedPlayer(Player $p){
	$this->redPlayers[$p->getName()] = array("red" => $p->getName());
}

public function addBluePlayer(Player $p){
	$this->bluePlayers[$p->getName()] = array("blue" => $p->getName());
}

public function pickTeam(Player $p){
if(count($this->redPlayers) === 5 && count($this->bluePlayers) === 5){
	$p->sendMessage("All teams are full! Removing you from the server! in 2 seconds!");
	$task = new kickTask($this, $this);
	$this->getServer()->getScheduler()->scheduleDelayedTask($task, 20*2);
	return;
} 

if(count($this->bluePlayers) < count($this->redPlayers)){
	$this->addBluePlayer($p);
	//tp to blue spot
}else{
	$this->addRedPlayer($p);
	//tp to red spot
}

}


public function onJoin(PlayerJoinEvent $ev){
	$p = $ev->getPlayer();
	$this->pickTeam($p);
	
}

}
