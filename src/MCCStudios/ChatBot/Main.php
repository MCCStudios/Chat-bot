<?php

# plugin by
# __  __  _____ _____    _____ _             _ _           
#|  \/  |/ ____/ ____|  / ____| |           | (_)          
#| \  / | |   | |      | (___ | |_ _   _  __| |_  ___  ___ 
#| |\/| | |   | |       \___ \| __| | | |/ _` | |/ _ \/ __|
#| |  | | |___| |____   ____) | |_| |_| | (_| | | (_) \__ \
#|_|  |_|\_____\_____| |_____/ \__|\__,_|\__,_|_|\___/|___/ ©
#                                                           

namespace MCCStudios\ChatBot;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\PluginCommand;
use pocketmine\Server;
use pocketmine\utils\TextFormat as TE;
use pocketmine\command\CommandExecutor;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;

class Main extends PluginBase implements Listener{


public function onEnable(){
$this->getServer()->getPluginManager()->registerEvents($this, $this);
$this->getLogger()->info("\n§f __  __  _____ _____    _____ _             _ _           
|  \/  |/ ____/ ____|  / ____| |           | (_)          
| \  / | |   | |      | (___ | |_ _   _  __| |_  ___  ___ 
| |\/| | |   | |       \___ \| __| | | |/ _` | |/ _ \/ __|
| |  | | |___| |____   ____) | |_| |_| | (_| | | (_) \__ \
|_|  |_|\_____\_____| |_____/ \__|\__,_|\__,_|_|\___/|___/ ©
                                                          \n§bChatBot §7by §dMCC §fStudios §aLoaded!");
                                                          
                                                          
                       
   
$botname = "Alex"; # SET THE CHATBOTS NAME HERE
$this->botname = $botname;
}

public function onPlayerJoin(PlayerJoinEvent $e) {
$p = $e->getPlayer();
$name = $p->getName();
# MESSAGE SENT BY THE BOT WHEN A PLAYER JOINS. CHANGE AS NEEDED.
$p->sendMessage("§7[§b" . $this->botname . "§7] §aWelcome back! Ask me anything by including my name in your messages!");
return true;
}



# HACK FOR MAKING PLAYER MESSAGE ABOVE BOTS RESPONSE TO MAKE IT LOOK GENUINE
# AND HIDE PLAYERS MESSAGE TO SERVER IF TALKING TO BOT (FOR LESS SPAM)
public function PlayerChatEvent1(PlayerChatEvent $e){
    $p = $e->getPlayer();
    $message = strtolower($e->getMessage());
    
	if(strpos(strtolower($message), strtolower($this->botname)) !== false){
        $e->setCancelled();
        $p->sendMessage("§7[§f" . $p->getName() . "§8: §f" . $message . "§7]");
        return true;
    }
}


# HANDLE PLAYER -> BOT COMMUNICATION
public function PlayerChatEvent2(PlayerChatEvent $e){
    $p = $e->getPlayer();
    $message = strtolower($e->getMessage());
    
    # ONLY PLAYERS WITH THIS PERMISSION CAN USE THE CHATBOT. PERMISSION IN PLUGIN.YML IS BY DEFAULT TRUE
	if(!$p->hasPermission("chatbot.use")){
		return false;
	}
    
    # THE BOT WILL ONLY RESPOND IF THE BOTS NAME IS IN THE PLAYERS MESSAGE.
    # IF YOU HAVENT ALREADY, CHANGE THE BOTNAME AT LINE 43
	if(strpos(strtolower($message), strtolower($this->botname)) !== false){

    

    # THESE STATEMENTS LET THE PLAYER SET THE TIME OF THE SERVER. DELETE IF NOT WANTED. 
    if(strpos($message, 'set') !== false && strpos($message, 'day') !== false) {
        $p->sendMessage("§7[§b" . $this->botname . "§7] §aSetting the time to day...");
		$level = $p->getLevel();
        $level->setTime(1000);
        return true;
    } else if(strpos($message, 'set') !== false && strpos($message, 'night') !== false) {
        $p->sendMessage("§7[§b" . $this->botname . "§7] §aSetting the time to night...");
		$level = $p->getLevel();
        $level->setTime(17000);
        return true;
        
    #######################################################################################
    # DEFINE ALL THE KEYWORDS AND RESPONSES HERE BY MAKING A NEW ELSEIF STATEMENT.        #
    # A FEW EXAMPLES HAVE BEEN GIVEN BELOW. SIMPLY COPY AND PASTE AND CHANGE THE KEYWORDS #
    # AND RESPONSES AS NEEDED                                                             #
    #######################################################################################


	# EXAMPLE 1
    } else if(strpos($message, 'hi') !== false) {
        $p->sendMessage("§7[§b" . $this->botname . "§7] §aHi there!");
        return true;

    # EXAMPLE 2
    } else if(strpos($message, 'how') !== false && strpos($message, 'you') !== false) {
        $p->sendMessage("§7[§b" . $this->botname . "§7] §aI am functioning within normal parameters ;)");
        return true; 

    # EXAMPLE 3
    } else if(strpos($message, 'bored')) {
        $p->sendMessage("§7[§b" . $this->botname . "§7] §aGo play some games!");
        return true; 

    # EXAMPLE 4
    } else if(strpos($message, 'bye')) {
        $p->sendMessage("§7[§b" . $this->botname . "§7] §aSee you later!");
        return true;         

    # EXAMPLE 5
    } else if(strpos($message, 'be') !== false && strpos($message, 'friend') !== false) {
        $p->sendMessage("§7[§b" . $this->botname . "§7] §aWe are now friends :)");
        return true;   
        








    # THIS IS WHAT THE CHATBOT SAYS IF IT DOES NOT HAVE A RESPONSE FOR THE PLAYERS MESSAGE. 
    # CHANGE THIS AS YOU WANT  
    } else {
        $p->sendMessage("§7[§b" . $this->botname . "§7] §aSorry, I do not have a response for that..");
        return true;     
    }    
}
}
}
