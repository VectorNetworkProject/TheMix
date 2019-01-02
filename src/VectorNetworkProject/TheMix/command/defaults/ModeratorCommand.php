<?php
/**
 * Copyright (c) 2018 - 2019 VectorNetworkProject. All rights reserved. MIT license.
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
use tokyo\pmmp\libform\element\Dropdown;
use tokyo\pmmp\libform\element\Slider;
use tokyo\pmmp\libform\FormApi;
use VectorNetworkProject\TheMix\command\Permissions;
use VectorNetworkProject\TheMix\game\corepvp\blue\BlueCoreManager;
use VectorNetworkProject\TheMix\game\corepvp\red\RedCoreManager;
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
        $this->setPermission(Permissions::ADMIN.'moderator');
    }

    /**
     * @param CommandSender $sender
     * @param string        $commandLabel
     * @param array         $args
     *
     * @return bool|mixed
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$this->testPermission($sender)) {
            return true;
        }
        $sender instanceof Player
            ? self::sendModeratorUI($sender)
            : $sender->sendMessage(TextFormat::RED.'プレイヤーのみ実行可能です。');

        return true;
    }

    public static function sendModeratorUI(Player $player): void
    {
        $form = FormApi::makeListForm(function (Player $player, ?int $data) {
            if (FormApi::formCancelled($data)) {
                return;
            }
            switch ($data) {
                case 0:
                    self::sendLevelManagerUI($player);
                    break;
                case 1:
                    self::sendCoreManagerUI($player);
                    break;
            }
        });
        $form->setTitle('Moderator Menu');
        $form->setContent('行う処理を選んで下さい。');
        $form->addButton(new Button('テレポート'));
        $form->addButton(new Button('CoreManager'));
        $form->sendToPlayer($player);
    }

    public static function sendLevelManagerUI(Player $player): void
    {
        $form = FormApi::makeListForm(function (Player $player, ?int $data) {
            if (FormApi::formCancelled($data)) {
                return;
            }
            switch ($data) {
                case 0:
                    $player->teleport(Server::getInstance()->getDefaultLevel()->getSpawnLocation());
                    break;
                case 1:
                    $player->teleport(new Position(0, 75, 0, Server::getInstance()->getLevelByName(DefaultConfig::getStageLevelName())));
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

    public static function sendCoreManagerUI(Player $player): void
    {
        $form = FormApi::makeCustomForm(function (Player $player, ?array $data) {
            if (FormApi::formCancelled($data)) {
                return;
            }
            if ($data[0] === 0) {
                RedCoreManager::setHP($data[1]);
                Server::getInstance()->broadcastMessage(TextFormat::GRAY.'[MODERATOR] '.$player->getName().'がREDチームのHPを'.$data[1].'に変更しました。');
            } else {
                BlueCoreManager::setHP($data[1]);
                Server::getInstance()->broadcastMessage(TextFormat::GRAY.'[MODERATOR] '.$player->getName().'がBLUEチームのHPを'.$data[1].'に変更しました。');
            }
        });
        $form->setTitle('CoreManager');
        $form->addElement(new Dropdown('HPを変更するチームを選んで下さい。', ['RED', 'BLUE']));
        $form->addElement(new Slider('HP', 1, 75));
        $form->sendToPlayer($player);
    }
}
