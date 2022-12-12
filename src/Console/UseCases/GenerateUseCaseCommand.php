<?php
/**
 * Author: Theo Champion
 * Date: 11/12/2022
 * Time: 18:03
 */


namespace LesIgnobles\BaseApiLaravel\Console\UseCases;


class GenerateUseCaseCommand extends BaseUseCaseGeneratorCommand
{
    protected $signature = "make:usecase {name} {--domain=}";
    protected $description = 'Create new UseCase class';
    protected $type = 'UseCase';

    protected function getStub(): string
    {
        return __DIR__ . '/stubs/usecase.stub';
    }

    public function handle()
    {
        parent::handle();
        $this->createRequest();
        $this->createData();
        $this->createResponse();
    }

    private function createRequest()
    {
        $this->call('make:usecase-request', [
            'name'   => $this->getNameInput(),
            '--domain' => $this->getDomainInput()
        ]);
    }

    private function createData()
    {
        $this->call('make:usecase-data', [
            'name'   => $this->getNameInput(),
            '--domain' => $this->getDomainInput()
        ]);
    }

    private function createResponse()
    {
        $this->call('make:usecase-response', [
            'name'   => $this->getNameInput(),
            '--domain' => $this->getDomainInput()
        ]);
    }
}
