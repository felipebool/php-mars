<?php

namespace App\Http\Controllers;

use App\Mars\Converter;
use App\Mars\ConverterInterface;
use App\Mars\Epoch\Epoch;
use App\Mars\Epoch\EpochInterface;
use App\Mars\LeapSeconds\LeapSeconds;
use App\Mars\LeapSeconds\LeapSecondsInterface;
use Illuminate\Http\Request;


class ConvertController extends Controller
{
    protected ConverterInterface $converter;
    protected EpochInterface $epoch;
    protected LeapSecondsInterface $leapSeconds;

    /**
     * Create a new controller instance.
     *
     * @param Epoch $epoch
     * @param Converter $converter
     * @param LeapSeconds $leapSeconds
     */
    public function __construct(
        Epoch $epoch,
        Converter $converter,
        LeapSeconds $leapSeconds
    ) {
        $this->converter = $converter;
        $this->epoch = $epoch;
        $this->leapSeconds = $leapSeconds;
    }

    public function convert(Request $request)
    {
        if (!$request->has('date')) {
            return response()->json(['message' => 'Missing date field'], 400);
        }

        try {
            new \DateTime($request->all()['date']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Unknown date format'],400);
        }

        $date = $request->all(['date'])['date'];
        $leapSeconds = $this->leapSeconds->getLeapSecondsSince($date);
        $j2000Offset = $this->epoch->getJ2000TimeOffsetTT($date, $leapSeconds);

        return response()->json(
            $this->converter->convert($date, $j2000Offset),
            200,
        );
    }
}
