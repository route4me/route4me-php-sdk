<?php
namespace Route4Me\Enum;

class Metric
{
    const EUCLIDEAN = 1; //measures point to point distance as a straight line
    const MANHATTAN = 2; //measures point to point distance as taxicab geometry line
    const GEODESIC  = 3; //measures point to point distance approximating curvature of the earth
    const MATRIX    = 4; //measures point to point distance by traversing the actual road network
    const EXACT_2D  = 5; //measures point to point distance using 2d rectilinear distance
}
