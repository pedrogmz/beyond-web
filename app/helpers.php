<?php

if (!function_exists('currentRoute')) {
    function currentRoute($route)
    {
        return request()->url() == route($route) ? ' class=current' : '';
    }
}

if (!function_exists('currentRouteBootstrap')) {
    function currentRouteBootstrap($route)
    {
        return request()->url() == route($route) ? ' class=active' : '';
    }
}

if (!function_exists('user')) {
    function user($id)
    {
        return \App\Models\User::findOrFail($id);
    }
}

if (!function_exists('locales')) {
    function locales()
    {
        $file = resolve (\Illuminate\Filesystem\Filesystem::class);
        $locales = [];
        $results = $file->directories(resource_path ('lang'));
        foreach ($results as $result) {
            $name = $file->name($result);
            if($name !== 'vendor') {
                $locales[$name] = $name;
            }
        }
        return $locales;
    }
}

if (!function_exists('timezones')) {
    function timezones()
    {
        $zones_array = [];
        $timestamp = time();
        foreach(timezone_identifiers_list() as $zone) {
            date_default_timezone_set($zone);
            $zones_array[$zone] = 'UTC' . date('P', $timestamp);
        }
        return $zones_array;
    }
}

if (!function_exists('setTabActive')) {
    function setTabActive()
    {
        return request ()->has('page') ? request ('page') : 1;
    }
}

if (!function_exists('thumb')) {
    function thumb($url)
    {
        return \App\Services\Thumb::makeThumbPath ($url);
    }
}

if(!function_exists('viewRace'))
{
	function viewRace($value) {
		$race = "";
		if($value==0) { $race = "war_1"; }
		elseif($value==1) { $race = "ninja_2"; }
		elseif($value==2) { $race = "sura_1"; }
		elseif($value==3) { $race = "shaman_2"; }
		elseif($value==4) { $race = "war_2"; }
		elseif($value==5) { $race = "ninja_1"; }
		elseif($value==6) { $race = "sura_2"; }
		elseif($value==7) { $race = "shaman_1"; }
		return $race;
	}
}

if(!function_exists('viewEmpire'))
{
	function viewEmpire($value) {
		$empire = "";
		if($value==1) { $empire = "shinso"; }
		elseif($value==2) { $empire = "chunjo"; }
		elseif($value==3) { $empire = "jinno"; }
		else { $empire = "null"; }
		return $empire;
	}
}

if(!function_exists('rango'))
{
	function rango($alignment) {
		if($alignment>=120000) {
			echo '<font color="#00CCFF">Caballero</font>';
		}
		elseif($alignment>=80000) {
			echo '<font color="#0090FF">Noble</font>';
		}
		elseif($alignment>=40000) {
			echo '<font color="#5C6EFF">Bueno</font>';
		}
		elseif($alignment>=1000) {
			echo '<font color="#5C6EFF">Amigable</font>';
		}
		elseif($alignment>=0) {
			echo 'Neutral';
		}
		elseif($alignment<0) {
			echo '<font color="#CF7500">Agresivo</font>';
		}
		elseif($alignment<= -40000) {
			echo '<font color="#EB5300">Fraudulento</font>';
		}
		elseif($alignment<= -80000) {
			echo '<font color="#E30000">Malicioso</font>';
		}
		elseif($alignment<= -120000) {
			echo '<font color="#FF0000">Cruel</font>';
		}
	}
}
