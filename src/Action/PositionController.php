<?php

namespace Felipecwb\Catho\Action;

use Felipecwb\Catho\Infra\PositionFile;
use Felipecwb\Catho\Domain\Repository\PositionRepository;
use Felipecwb\Catho\Domain\Service\PositionService;

use Symfony\Component\HttpFoundation\Request;

class PositionController extends Controller
{
    public function find(Request $request)
    {
        $params = array();
        if ($request->query->has('title')) {
            $params['title'] = $request->query->get('title');
        }

        if ($request->query->has('description')) {
            $params['description'] = $request->query->get('description');
        }

        $salaryOrder = $request->query->get('salary_order');
        $positions = $this->getService()->findAll($params, $salaryOrder);

        return $this->app->json($positions);
    }

    public function locations(Request $request)
    {
        return $this->app->json($this->getService()->getAvailableLocations());
    }

    /**
     * @return PositionService
     */
    protected function getService()
    {
        $file = new PositionFile($this->app['file.positions']);
        $file->setCache($this->getCache());

        $repository = new PositionRepository($file, $this->getCache());

        return new PositionService($repository);
    }
}
