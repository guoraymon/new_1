<?php

use App\Models\UserModel;

class game
{
    public function rand()
    {
        $cfg = [
            1 => [
                'id' => 1,
                'text' => '遭遇小妖',
                'prob' => 8,
            ],
            2 => [
                'id' => 2,
                'text' => '遭遇妖怪头目',
                'prob' => 1,
            ],
            3 => [
                'id' => 3,
                'text' => '什么都没发生',
                'prob' => 1,
            ],
        ];

        $event = $this->getProbItem($cfg);
        switch ($event['id']) {
            case 1:
                return $event['text'] . '，' . $this->pve();
            case 2:
                return $event['text'] . '，' . $this->pvb();
            case 3:
                return $event['text'];
            default:
                return null;
        }
    }

    /**
     * 打小怪
     */
    private function pve()
    {
        if (mt_rand(1, 10) >= 3) {
            $user = UserModel::find(1);
            $user->mp += 100;
            $user->save();
            return '打赢了';
        }
        return '打输了';
    }

    /**
     * 打大怪
     */
    private function pvb()
    {
        if (mt_rand(1, 10) >= 5) {
            $user = UserModel::find(1);
            $user->mp += 500;
            $user->save();
            return '打赢了';
        }
        return '打输了';
    }

    private function getProbSum($list)
    {
        $sum = 0;
        foreach ($list as $item) {
            $sum += $item['prob'];
        }
        return $sum;
    }

    private function getProbItem($list)
    {
        $rand = mt_rand(1, $this->getProbSum($list));
        foreach ($list as $item) {
            if ($rand <= $item['prob']) {
                return $item;
            }
            $rand -= $item['prob'];
        }
        return null;
    }
}