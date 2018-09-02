<?php
/**
 * Created by PhpStorm.
 * User: gates
 * Date: 2018. 09. 02.
 * Time: 2:23
 */

namespace LKDev\HetznerCloud\Models\Actions;

use LKDev\HetznerCloud\HetznerAPIClient;
use LKDev\HetznerCloud\Models\Model;

class Metrics extends Model
{
    /**
     * @var string
     */
    public $start;

    /**
     * @var string
     */
    public $end;

    /**
     * @var int
     */
    public $step;
    /**
     * @var array
     */
    public $time_series;

    /**
     * Action constructor.
     *
     * @param string $start
     * @param string $end
     * @param int $step
     * @param array $time_series
     */
    public function __construct(
        string $start,
        string $end,
        int $step = null,
        $time_series = []
    )
    {
        $this->start = $start;
        $this->end = $end;
        $this->step = $step;
        $this->time_series = $time_series;
        parent::__construct();
    }

    /**
     * @param $input
     * @return \LKDev\HetznerCloud\Models\Actions\Metrics|static
     */
    public static function parse($input)
    {
        if ($input == null) {
            return null;
        }

        return new self($input->start, $input->end, $input->step, $input->time_series);
    }
}