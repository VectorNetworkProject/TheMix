<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\command\defaults;


use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\level\Position;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use tokyo\pmmp\libform\element\Button;
use tokyo\pmmp\libform\FormApi;
use VectorNetworkProject\TheMix\command\Permissions;
use VectorNetworkProject\TheMix\game\DefaultConfig;

class ModeratorCommand extends PluginCommand
{
    /**
     * ModeratorCommand constructor.
     *
     * @param Plugin $owner
     */
    public function __construct(Plugin $owner)
    {
        parent::__construct('moderator', $owner);
        $this->setDescription('モデレーター専用メニュー(管理権限持ちのユーザー以外使用不可能)');
        $this->setPermission(Permissions::ADMIN . 'moderator');
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     * @return bool|mixed
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$this->testPermission($sender)) {
            return true;
        }
        if (!$sender instanceof Player) {
            $sender->sendMessage(TextFormat::RED . 'プレイヤーのみ実行可能です。');
            return true;
        }
        self::sendModeratorUI($sender);
        return true;
    }

    public static function sendModeratorUI(Player $player): void
    {
        $form = FormApi::makeListForm(function (Player $player, ?int $data) {
            if (FormApi::formCancelled($data)) return;
            switch ($data) {
                case 0:
                    self::sendLevelManagerUI($player);
                    break;
            }
        });
        $form->setTitle('Moderator Menu');
        $form->setContent('行う処理を選んで下さい。');
        $form->addButton(new Button('テレポート'));
        $form->sendToPlayer($player);
    }

    public static function sendLevelManagerUI(Player $player): void
    {
        $form = FormApi::makeListForm(function (Player $player, ?int $data) {
            if (FormApi::formCancelled($data)) return;
            switch ($data) {
                case 0:
                    $player->teleport(Server::getInstance()->getDefaultLevel()->getSpawnLocation());
                    break;
                case 1:
                    $player->teleport(new Position(256, 5, 256, Server::getInstance()->getLevelByName(DefaultConfig::getStageLevelName())));
                    break;
                case 2:
                    self::sendModeratorUI($player);
                    break;
            }
        });
        $form->setTitle('WorldManager');
        $form->setContent('テレポートするワールドを選択して下さい。');
        $form->addButton(new Button('lobby(default world)'));
        $form->addButton(new Button('Stage'));
        $form->addButton(new Button('戻る'));
        $form->sendToPlayer($player);
    }
}
