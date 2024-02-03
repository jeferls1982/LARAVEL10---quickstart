<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:structure {argument}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create files to work in substructure';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $argument = $this->argument('argument');

        $makeModelCommand = "make:model $argument -m";
        $this->makeModel($makeModelCommand);

        $this->createRepository($argument);
        $this->createManager($argument);
        $this->createController($argument);

    }

    private function createRepository($argument){
        $path = 'app/Substructure/Repositories/'.$argument."Repository.php";
        $conteudo = $this->makeContentRepository($argument);
        $this->makeDIr($path);
        $this->filePutContent($path, $conteudo);
    }

    private function createManager($argument){
        $path = 'app/Substructure/Managers/'.$argument."Manager.php";
        $conteudo = $this->makeContentManager($argument);
        $this->makeDIr($path);
        $this->filePutContent($path, $conteudo);
    }

    private function createController($argument){
        $path = 'app/Http/Controllers/'.$argument.'Controller.php';
        $conteudo = $this->makeContentController($argument);
        $this->makeDIr($path);
        $this->filePutContent($path, $conteudo);
    }

    private function makeDIr($path){
        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0777, true);
        }
    }

    private function filePutContent($path,$conteudo){
        if (!file_exists($path)) {
            file_put_contents($path, $conteudo);
            $this->info("Create: ".$path);
        } else {
            $this->info("File already exists: ".$path);
        }
    }

    private function makeContentRepository($argument){
        $name = $argument.'Repository';
        $content = $this->makeRepository();
        $content = str_replace('$argument', $argument, $content);
        $content = str_replace('$name', $name, $content);
        return $content;
    }

    private function makeContentManager($argument){
        $repositoryName = $argument.'Repository';
        $managerName = $argument.'Manager';
        $content = $this->makeManager();
        $content = str_replace('$managerName', $managerName, $content);
        $content = str_replace('$repositoryName', $repositoryName, $content);
        return $content;
    }

    private function makeContentController($argument){

        $nameController = $argument.'Controller';
        $nameRepository = $argument.'Repository';
        $nameManager = $argument.'Manager';

        $content = $this->makeController();
        $content = str_replace('$nameController', $nameController, $content);
        $content = str_replace('$nameRepository', $nameRepository, $content);
        $content = str_replace('$nameManager', $nameManager, $content);

        return $content;
    }

    public function makeModel($makeModelCommand){

        Artisan::call($makeModelCommand);
        $output = Artisan::output();
        $this->info($output);

    }

    public function makeRepository(){
        return
            '<?php

namespace App\Substructure\Repositories;

use App\Models\$argument;

class $name extends BaseRepository
{
    protected $model = $argument::class;
}
';

    }

    public function makeManager(){
        return
            '<?php

namespace App\Substructure\Managers;

use App\Substructure\Repositories\$repositoryName;

class $managerName extends BaseManager
{
    public function __construct($repositoryName $repository)
    {
        $this->repository = $repository;
    }
}
';

    }

    public function makeController(){
        return
            '<?php

namespace App\Http\Controllers;

use App\Substructure\Managers\$nameManager;
use App\Substructure\Repositories\$nameRepository;
use Freelabois\LaravelQuickstart\Extendables\CrudController;
use Illuminate\Http\Client\Request;


class $nameController extends CrudController
{
    public function __construct(
        $nameManager    $manager,
        $nameRepository $repository
    )
    {
        parent::__construct($manager, $repository);
    }
}
';
    }
}