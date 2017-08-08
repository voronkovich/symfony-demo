<?php

namespace AppBundle\DataCollector;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

/**
 * Collects environment variables loaded by Dotenv component.
 *
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 */
class DotenvDataCollector extends DataCollector
{
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        $this->data['envs'] = array();

        $loadedVars = array_filter(explode(',', getenv('SYMFONY_DOTENV_VARS')));

        foreach ($loadedVars as $var) {
            if (false !== getenv($var)) {
                $this->data['envs'][$var] = getenv($var);
            }
        }
    }

    public function getEnvs()
    {
        return $this->data['envs'];
    }

    public function getName()
    {
        return 'dotenv';
    }
}
