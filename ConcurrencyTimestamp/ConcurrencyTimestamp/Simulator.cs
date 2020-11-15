using System;
using System.Collections.Generic;
using System.Text;

namespace ConcurrencyTimestamp
{
    class Simulator
    {
        readonly List<string> transactionList;
        Dictionary<string, int> x;
        Dictionary<string, int> y;
        Dictionary<string, int> z;

        public Simulator(List<string> list)
        {
            transactionList = list;
        }

        public void StartSimulator()
        {
            Console.WriteLine("-- História --");
            int _i = 1;

            foreach(string transaction in transactionList)
            {
                Console.WriteLine("H"+_i+" = "+ transaction);
                _i++;
            }

            x = new Dictionary<string, int>()
            {
                { "r", 0 }, { "w", 0 }
            };

            y = new Dictionary<string, int>()
            {
                { "r", 0 }, { "w", 0 }
            };

            z = new Dictionary<string, int>()
            {
                { "r", 0 }, { "w", 0 }
            };

            this.Schedule();
        }

        private void Schedule()
        {

        }
    }
}
