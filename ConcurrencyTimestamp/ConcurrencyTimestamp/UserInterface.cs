using System;
using System.Collections.Generic;
using System.Text;

namespace ConcurrencyTimestamp
{
    class UserInterface
    {
        List<string> transactionList;
        Simulator simulator;

        public void ShowUserInput()
        {
            int _i = 1;
            string _transaction;
            transactionList = new List<string>();
            Console.WriteLine("Digite as transações, quando não quiser mais, deixe a linha em branco");

            Console.WriteLine("Digite a transação "+_i+": ");
            _transaction = Console.ReadLine();

            while (_transaction != "")
            {
                transactionList.Add(_transaction);
                _i++;
                Console.WriteLine("Digite a transação " + _i + ": ");
                _transaction = Console.ReadLine();
            }

            this.InitSimulator();
        }

        private void InitSimulator()
        {
            simulator = new Simulator(transactionList);
            simulator.StartSimulator();
        }
    }
}
