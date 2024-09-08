import React from 'react';
import { Head, useForm, usePage } from '@inertiajs/react';
// import { PageProps } from '@/types';
import { useMask } from '@react-input/mask';

enum SimulationTypes {
    light = 'Conta de Luz',
    credit = 'Cartão de Crédito',
    fgts = 'FGTS'
}

export default function Simulation() {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        phone: '',
        CPF: '',
        type: SimulationTypes.light,
        hasLightAccount: false,
        hasWorked: false,
        amountForCredit: '',
        installmentsForCredit: '1'
    });
    const wappMask = useMask({ mask: '(__) _____-____', replacement: { _: /\d/ } });
    const cpfMask = useMask({ mask: '___.___.___-__', replacement: { _: /\d/ } });
    const { flash } = usePage().props

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post('/simulacao', {
            preserveState: true,
            onSuccess: () => {
                reset();
            }
        });
    }

    React.useEffect(() => {
        setData('hasLightAccount', false);
        setData('hasWorked', false);
        setData('amountForCredit', '');
        setData('installmentsForCredit', '1');
    }, [ data.type ]);

    return (
        <>
            <Head title="Simule agora o seu empréstimo" />
            <div className="d-flex justify-content-center align-items-center justify-content-between">
                <section style={{ maxWidth: '700px' }} className="margin-auto">
                    <h4 className="color-white" style={{ textAlign: 'center', marginBottom: '2rem' }}>Simule agora</h4>
                    {(flash as any).success && (
                        <div className="alert alert-success">{(flash as any).success}</div>
                    )}
                    {(flash as any).error && (
                        <div className="alert alert-error">{(flash as any).error}</div>
                    )}
                    <form method="post" onSubmit={handleSubmit} className="form-block">
                        <div className="row gtr-uniform">
                            <div className="col-4 col-12-xsmall">
                                <label htmlFor="name">Nome</label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    value={data.name} 
                                    placeholder="Digite seu nome" 
                                    onChange={(e) => setData('name', e.target.value)}
                                    required
                                />
                                {errors.name && <div>{errors.name}</div>}
                            </div>
                            <div className="col-4 col-12-xsmall">
                                <label htmlFor="phone">WhatsApp</label>
                                <input 
                                    type="text"
                                    name="phone"
                                    value={data.phone} 
                                    placeholder="WhatsApp" 
                                    onChange={(e) => setData('phone', e.target.value)}
                                    ref={wappMask}
                                    required
                                />
                                {errors.phone && <div>{errors.phone}</div>}
                            </div>
                            <div className="col-4 col-12-xsmall">
                                <label htmlFor="cpf">CPF</label>
                                <input 
                                    type="text" 
                                    name="cpf" 
                                    value={data.CPF} 
                                    placeholder="Digite seu CPF" 
                                    onChange={(e) => setData('CPF', e.target.value)}
                                    ref={cpfMask}
                                    required
                                />
                                {errors.CPF && <div>{errors.CPF}</div>}
                            </div>
                            <div className="col-12">
                                <label htmlFor="type">Tipo de simulação</label>
                                <select name="type" id="demo-category" onChange={(e) => setData('type', e.target.value as SimulationTypes)} required>
                                    {Object.values(SimulationTypes).map((value) => (
                                        <option key={value} value={value}>{value}</option>
                                    ))}
                                </select>
                            </div>
                            {data.type === SimulationTypes.light && (
                                <div className="row">
                                    <p className="color-black">A conta de luz está no seu nome?</p>
                                    <div className="col-6">
                                        <input type="radio" id="demo-priority-low" name="light-account" onChange={() => setData('hasLightAccount', true)} required />
                                        <label htmlFor="demo-priority-low">Sim</label>
                                    </div>
                                    <div className="col-6">
                                        <input type="radio" id="demo-priority-normal" name="light-account" onChange={() => setData('hasLightAccount', false)} required />
                                        <label htmlFor="demo-priority-normal">Não</label>
                                    </div>
                                </div>
                            )}
                             {data.type === SimulationTypes.credit && (
                                <>
                                    <div className="col-6 col-12-xsmall">
                                        <label htmlFor="amountForCredit">Valor que deseja</label>
                                        <input 
                                            type="text"
                                            name="amountForCredit"
                                            value={data.amountForCredit} 
                                            placeholder="Valor que deseja" 
                                            onChange={(e) => setData('amountForCredit', e.target.value)}
                                            required
                                        />
                                    </div>
                                    <div className="col-6 col-12-xsmall">
                                        <label htmlFor="installmentsForCredit">Parcelas</label>
                                        <select name="type" id="demo-category" onChange={(e) => setData('installmentsForCredit', e.target.value)} required>
                                            {installmentOptions.map((value) => (
                                                <option key={value} value={value}>{value}</option>
                                            ))}
                                        </select>
                                    </div>
                                </>
                            )}
                             {data.type === SimulationTypes.fgts && (
                                <div className="row">
                                    <p className="color-black">Trabalha ou já trabalhou de carteira assinada?</p>
                                    <div className="col-6">
                                        <input type="radio" id="demo-priority-low" name="has-worked" onChange={() => setData('hasWorked', true)} required />
                                        <label htmlFor="demo-priority-low">Sim</label>
                                    </div>
                                    <div className="col-6">
                                        <input type="radio" id="demo-priority-normal" name="has-worked"  onChange={() => setData('hasWorked', false)} required />
                                        <label htmlFor="demo-priority-normal">Não</label>
                                    </div>
                                </div>
                            )}
                            <div className="col-12" style={{ marginTop: '1rem' }}>
                                <ul className="actions">
                                    <li className="margin-auto">
                                        <input type="submit" value="Enviar" className="primary" />
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </>
    );
}

const installmentOptions = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
