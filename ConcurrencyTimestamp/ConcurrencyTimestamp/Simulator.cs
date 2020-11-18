using System;
using System.Collections.Generic;


namespace ConcurrencyTimestamp
{
    class Simulator
    {
        readonly List<string> transactionList;
        List<string[]> transactions;
        List<string> timestampList;
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

            this.Normalize();
            this.Schedule();
        }

        public void Normalize()
        {
            transactions = new List<string[]>();
\
            foreach (string element in transactionList)
            {
                //timestampList.Add(Utils.GetTimestamp());
                transactions.Add(element.Trim().Split("-".ToCharArray()));
            }
        }

        private void Schedule()
        {
            int _ts;

            foreach (string[] vector in transactions)
            {
                for(int i = 0; i < vector.Length; i++)
                {
                    char[] _element = vector[i].Trim().ToCharArray();
                    
                    switch(char.ToLower(_element[_element.Length - 1]))
                    {
                        case 'x':

                            if (char.ToLower(_element[0]) == 'r')
                            {
                                Console.Write("leitura: ");

                                _ts = x["r"];

                            }
                            else if (char.ToLower(_element[0]) == 'w')
                            {
                                Console.Write("escrita: ");

                                _ts = x["w"];
                            }
                            Console.WriteLine("\n"); 
                        break;
                        case 'y':

                            if (char.ToLower(_element[0]) == 'r')
                            {
                                Console.Write("leitura: ");

                                _ts = y["r"];

                            }
                            else if (char.ToLower(_element[0]) == 'w')
                            {
                                Console.Write("escrita: ");

                                _ts = y["w"];
                            }
                            Console.WriteLine("\n");
                            break;

                        case 'z':

                            if (char.ToLower(_element[0]) == 'r')
                            {
                                Console.Write("leitura: ");

                                _ts = z["r"];

                            }
                            else if (char.ToLower(_element[0]) == 'w')
                            {
                                Console.Write("escrita: ");

                                _ts = z["w"];
                            }
                            Console.WriteLine("\n");
                        break;
                    }
                }
            }
        }
    }
}
