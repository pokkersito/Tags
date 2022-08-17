<?php

namespace Pokker77;

//credits to my friend Darking who helped me when something gave me an error since I'm not very professional in this xd

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\Player;
use pocketmine\event\player\PlayerInteractEvent;

class Main extends PluginBase implements Listener {

    public function configUpdater(): void {
        $settings = new Config($this->getDataFolder() . "settings.yml", Config::YAML);
		if($settings->get("version") !== "1.1.0"){
			rename($this->getDataFolder() . "settings.yml", $this->getDataFolder() . "settings_old.yml");
			$this->saveResource("settings.yml");
            $this->getLogger()->notice("We create a new settings.yml file for you.");
            $this->getLogger()->notice("Because the config version has changed. Your old configuration has been saved as settings_old.yml.");
		}
	}

    public function onEnable(): void{
        $this->configUpdater();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveResource("settings.yml");
    }

    public function onDisable(): void
	{
	}

    public function onCommand(CommandSender $sender, Command $command, $label, array $args): bool{
        $commandName = $command->getName();
        $this->getLogger()->info("commando: ".$commandName);
        if($commandName === "tags"){
            $settings = new Config($this->getDataFolder() . "settings.yml", Config::YAML);
            $lista = $settings->get("list");
$rangos = implode(", ", $lista);  
$sender->sendMessage($rangos);
            return true;

        }

        return true;
    }
}