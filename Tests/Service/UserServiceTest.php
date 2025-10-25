<?php

namespace App\Service;

use App\Entity\User;
use App\Interfaces\UserRepositoryInterface;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    public function testAddUser()
    {
        // 1. ARRANGE (ПОДГОТОВКА)
        // Создаем МОК (заглушку) для репозитория.
        // Она будет имитировать реальный репозиторий.
        $userRepositoryMock = $this->createMock(UserRepositoryInterface::class);
        $userForTest = new User(uniqid(), 'max', date("d.m.Y h:i:s"));

        // Настраиваем заглушку.
        // Мы ожидаем, что метод save будет вызван ровно 1 раз.
        $userRepositoryMock->expects($this->once())
                         ->method('save')
                         ->willReturn($userForTest); // Можно заставить метод возвращать определенное значение

        // Создаем экземпляр тестируемого сервиса, передавая ему заглушку
        $userService = new UserService($userRepositoryMock);

        // 2. ACT (ДЕЙСТВИЕ)
        // Вызываем метод, который хотим протестировать
        $result = $userService->addUser('max');

        // 3. ASSERT (ПРОВЕРКА)
        // Проверяем, что метод вернул то, что ожидалось
        // Например, что он вернул объект пользователя
        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals('max', $result->getName());
    }
}